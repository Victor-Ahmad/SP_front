<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\error;

class ChatController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }



    public function chats()
    {
        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }

        try {

            $response = $this->apiService->getChats();
            $chats =  $response['result'];
            // $chats = [];
            // foreach ($response['result'] as $chat) {
            //     $chats[] = [
            //         'id' => $chat['id'],
            //         'name' => $chat['other_person']['first_name'] . ' ' . $chat['other_person']['last_name'],
            //         'location' => $chat['other_person']['one_to_one_swap_house']['location'] . ', ' . $chat['other_person']['one_to_one_swap_house']['street'],
            //         'updated_at' => $chat['updated_at'],
            //     ];
            // }

            return view('chats', ['chats' => $chats]);
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }



    public function showChatMessages($id, $page = 1)
    {
        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }

        try {

            $chat = $this->apiService->getChatMessages($id, $page);

            return view('single_chat', ['chat' => $chat['result'][0]]);
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }



    public function checkChat($userId)
    {
        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }
        try {

            $response = $this->apiService->checkChat($userId);
            if (isset($response['result'][0]['chat']) ?? false) {
                return redirect()->route('chat.show', ['id' => $response['result'][0]['chat']['id']]);
            } else {
                return redirect()->route('chat.show', ['id' => $response['result']['id']]);
            }
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
