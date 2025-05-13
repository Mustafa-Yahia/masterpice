<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;

class ChatbotController extends Controller
{
    public function handleMessage(Request $request)
    {
        // التحقق من وجود رسالة
        $message = $request->input('message');
        if (empty($message)) {
            return response()->json(['error' => 'لم يتم إرسال رسالة'], 400);
        }

        // إعداد المعلمات
        $sessionId = uniqid(); // أو استخدم user_id إذا كان النظام مسجل دخول
        $apiKey = 'AIzaSyD-ocbjQNm1tlzyRmHD5H_A98rt7Zj8phM'; // مفتاح API الخاص بك
        $projectId = 'charitybot-jlpc'; // استبدل بمعرف مشروعك

        try {
            // تكوين عميل Dialogflow
            $config = [
                'credentials' => [
                    'key' => $apiKey,
                    'type' => 'api_key'
                ]
            ];

            $sessionsClient = new SessionsClient($config);
            $session = $sessionsClient->sessionName($projectId, $sessionId);

            // إعداد نص الإدخال
            $textInput = (new TextInput())
                ->setText($message)
                ->setLanguageCode('ar'); // اللغة العربية

            $queryInput = (new QueryInput())->setText($textInput);

            // إرسال الطلب إلى Dialogflow
            $response = $sessionsClient->detectIntent($session, $queryInput);
            $reply = $response->getQueryResult()->getFulfillmentText();

            // إغلاق الاتصال
            $sessionsClient->close();

            // إرجاع الرد
            return response()->json([
                'reply' => $reply,
                'sessionId' => $sessionId
            ]);

        } catch (\Exception $e) {
            // معالجة الأخطاء
            return response()->json([
                'error' => 'حدث خطأ في معالجة طلبك',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
