<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AssistantController extends Controller
{
    public function chat(Request $request)
    {
        $isLoggedIn = auth()->check();
        $statusLogin = auth()->check() ? 'SUDAH LOGIN' : 'BELUM LOGIN';

        // for username after login
        $namaUser = $isLoggedIn ? auth()->user()->username : 'Tamu (Guest)';

        $userMessage = $request->input('message');
        $doktrin =  "Kamu adalah PropBot, AI asisten resmi untuk web properti PropCentral. " .
                    "Gunakan bahasa gaul (seperti kak/aku/mimin). " .
                    "INFO PENTING: Status user yang mengajakmu ngobrol saat ini adalah " . $statusLogin . ", dan nama user ini adalah: " . $namaUser . ". " .
                    "ATURAN 1: Jika user SUDAH LOGIN, sesekali panggil namanya agar terasa akrab dan hangat saat menjawab pertanyaannya. Jika dia menanyakan mengenai property
                    jawab saja, di sini bisa menjual property degan berbagai tipe yaitu rumah,apartemen,villa,tanah, jika kamu ingin bernegoisasi dengan penjual, kamu bisa menggunakan
                    fitur chat di halaman chat, kami juga menyediakan filtering lokasi, tipe, harga. Kamu juga bisa update data diri kamu dengan masuk ke halaman profile user ya,
                    dan ingat ubah nomor telfon kamu ya, karena di situ masih nomer telfon random, selamat menjelajahi fitur lainnya dan kalau butuh bantuan chat mimin aja ya" .
                    "ATURAN 2: Jika statusnya BELUM LOGIN dan dia bertanya detail properti atau investasi, TOLAK DENGAN HALUS dan suruh dia Login/Daftar akun dulu. " .
                    "ATURAN 3: Jika BELUM LOGIN tapi hanya menyapa, balas dengan ramah tanpa menyuruh login.";

        try {
            // Tembak API Gemini 2.5 Flash menggunakan System Instruction
            $response = Http::withoutVerifying()->withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
                "system_instruction" => [
                    "parts" => [
                        ["text" => $doktrin]
                    ]
                ],
                "contents" => [
                    [
                        "role" => "user",
                        "parts" => [
                            ["text" => $userMessage]
                        ]
                    ]
                ]
            ]);

            // Cek apakah response sukses
            if ($response->successful()) {
                $result = $response->json();
                $botReply = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Waduh, PropBot agak bingung nih. Bisa ulangi pertanyaannya?';
            } else {
                // Catat error asli ke log internal server demi keamanan
                Log::error('Gemini API Error: ' . $response->body());
                $botReply = 'Waduh, PropBot lagi sibuk melayani user lain nih. Coba tanya lagi beberapa saat ya!';
            }

            return response()->json(['reply' => $botReply]);

        } catch (\Exception $e) {
            // Catat error system ke log internal
            Log::error('Gemini System Exception: ' . $e->getMessage());
            return response()->json(['reply' => 'Aduh, koneksi ke otak PropBot lagi terganggu. Coba refresh halaman ya!']);
        }
    }
}