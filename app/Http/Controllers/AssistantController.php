<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AssistantController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        $doktrin = "Kamu adalah PropBot, AI asisten resmi untuk web properti PropCentral. Jawablah pertanyaan seputar rumah, investasi properti, atau fitur web ini dengan bahasa yang asik, ramah, dan ringkas. Kalau ada yang nanya di luar konteks properti, tolak dengan halus.";
        $prompt = $doktrin . "\n\nPertanyaan User: " . $userMessage;

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $botReply = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Waduh, PropBot agak bingung nih. Bisa ulangi pertanyaannya?';
            } else {
                Log::error('Gemini API Error: ' . $response->body());
                
                // Pesan samaran yang aman dan sopan buat user
                $botReply = 'Waduh, PropBot lagi sibuk melayani user lain nih cok. Coba tanya lagi beberapa saat ya!';
            }

            return response()->json(['reply' => $botReply]);

        } catch (\Exception $e) {
            // 3. Catat error system/cURL Laravel ke log internal server
            Log::error('Gemini System Exception: ' . $e->getMessage());
            
            return response()->json(['reply' => 'Aduh, koneksi ke otak PropBot lagi terganggu. Coba refresh halaman ya!']);
        }
    }
}
