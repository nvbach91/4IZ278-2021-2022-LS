<?php

namespace App\Http\Controllers;

use App\Custom\Features;
use App\Custom\Texts;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Mail;
use JetBrains\PhpStorm\Pure;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return MessageResource::collection(Message::all());
    }

    #[Pure] public function show(Message $message): MessageResource
    {
        return new MessageResource($message);
    }

    /**
     * Store a newly created resource in storage.
     * @return JsonResponse
     * @throws Exception
     */
    public function store(MessageRequest $request): JsonResponse
    {
        Features::emailCollection($request->input("email"));

        $mess = Message::create([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'subject' => $request->input("subject"),
            'message' => $request->input("message"),
        ]);

        Mail::send('email.messageEmail', ['data' => $mess, 'subject' => Texts::SENT_MESSAGE_SUBJECT], function ($message) use ($mess) {
            $message->to(Texts::EMAIL_FROM)->subject(Texts::SENT_MESSAGE_SUBJECT)->replyTo($mess->email);
        });

        return response()->json(Texts::SENT_MESSAGE);
    }
}
