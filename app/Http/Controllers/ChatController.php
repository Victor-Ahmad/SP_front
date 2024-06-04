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
            $response2 = $this->apiService->checkNewMessages();
            $newChats = [];
            foreach ($chats as $chat) {

                if (in_array($chat['id'], $response2['result'][0]['chat_ids'])) {
                    $chat['unread'] = '1';
                } else {
                    $chat['unread'] = '0';
                }
                $newChats[] = $chat;
            }

            return view('chats', ['chats' => $newChats]);
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
            $chatId = isset($response['result']['id']) ? $response['result']['id'] : $response['result'][0]['chat']['id'];
            return redirect()->route('chat.show', ['id' => $chatId]);
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch unread messages'], 500);
        }
    }



    public function checkUnreadMessages()
    {
        if (!Session::get('token')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $response = $this->apiService->checkNewMessages();
            $unreadCount = isset($response['result'][0]['count']) ? $response['result'][0]['count'] : 0;
            return response()->json(['unreadCount' => $unreadCount]);
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch unread messages'], 500);
        }
    }
}
