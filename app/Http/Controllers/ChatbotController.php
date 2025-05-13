<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    /**
     * معالجة رسائل الشات بوت
     */
    public function handleMessage(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $message = $request->input('message');
        $sessionId = $request->input('session_id', uniqid());

        try {
            // تكوين اتصال Dialogflow
            $config = [
                'credentials' => [
                    'key' => env('DIALOGFLOW_API_KEY'),
                    'type' => 'api_key'
                ],
                'projectId' => env('DIALOGFLOW_PROJECT_ID')
            ];

            $sessionsClient = new SessionsClient($config);
            $session = $sessionsClient->sessionName(
                $config['projectId'],
                $sessionId
            );

            // إعداد نص الإدخال
            $textInput = (new TextInput())
                ->setText($message)
                ->setLanguageCode('ar'); // اللغة العربية

            $queryInput = (new QueryInput())->setText($textInput);

            // إرسال الطلب إلى Dialogflow
            $response = $sessionsClient->detectIntent($session, $queryInput);
            $queryResult = $response->getQueryResult();

            // تسجيل التفاعل (اختياري)
            $this->logInteraction(
                $sessionId,
                $message,
                $queryResult->getFulfillmentText(),
                $queryResult->getIntent()->getDisplayName()
            );

            // بناء الاستجابة
            $responseData = [
                'reply' => $queryResult->getFulfillmentText(),
                'intent' => $queryResult->getIntent()->getDisplayName(),
                'confidence' => $queryResult->getIntentDetectionConfidence(),
                'session_id' => $sessionId,
                'parameters' => json_decode($queryResult->getParameters()->serializeToJsonString(), true)
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            Log::error('Dialogflow Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'حدث خطأ في معالجة طلبك',
                'technical_error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        } finally {
            if (isset($sessionsClient)) {
                $sessionsClient->close();
            }
        }
    }

    /**
     * تسجيل تفاعلات المستخدم (اختياري)
     */
    protected function logInteraction($sessionId, $message, $reply, $intent)
    {
        Log::info("Chatbot Interaction", [
            'session_id' => $sessionId,
            'user_message' => $message,
            'bot_reply' => $reply,
            'intent' => $intent,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        // يمكنك هنا إضافة حفظ التفاعل في قاعدة البيانات إذا لزم الأمر
        /*
        ChatLog::create([
            'session_id' => $sessionId,
            'message' => $message,
            'response' => $reply,
            'intent' => $intent
        ]);
        */
    }

    /**
     * واجهة اختبار الشات بوت (للتطوير فقط)
     */
    public function testChatbot()
    {
        return view('chatbot-test');
    }
}
