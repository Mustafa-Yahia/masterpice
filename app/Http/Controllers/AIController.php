<?php
use App\Services\ChatGPTService;
use Illuminate\Http\Request;

class AIController extends Controller
{
    protected $chatGPT;

    public function __construct(ChatGPTService $chatGPT)
    {
        $this->chatGPT = $chatGPT;
    }

   public function ask(Request $request)
{
    $request->validate([
        'prompt' => 'required|string|max:1000',
    ]);

    $response = $this->chatGPT->ask($request->prompt);

    return response()->json([
        'response' => $response
    ]);
}
}
