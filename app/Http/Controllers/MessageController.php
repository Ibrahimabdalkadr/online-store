<?php

namespace App\Http\Controllers;

use App\Events\SupportMessageSent;
use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends ApiController
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticket_id' => ['required', 'integer', 'exists:tickets,id'],
            'body' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return $this->errorResponse('validation', $validator->errors(), 422);
        }

        try {
        $ticket = Ticket::where('id', $request->ticket_id)->first();
        if (!$ticket)  return $this->errorResponse('Ticket not found', [], 404);

        $senderId = auth()->id();
        if ($ticket->user_id === auth()->id()) {
            $receiverId = $ticket->assignedTo->id;
        } else {
            $receiverId = $ticket->user_id;
        }

        $message = $ticket->messages()->create([
            'body' => $request->body,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'ticket_id'=> $ticket->id

        ]);


        event(new SupportMessageSent($request->user(),$message));

        return $this->successResponse('Message sent successfully', [
            'message' => $message
        ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show($ticket_id)
    {
        try {
        $ticket = Ticket::where('id', $ticket_id)->first();
        $messages = $ticket->messages;
            return $this->successResponse('Message sent successfully', [
                'message' => $messages
            ]);
        }catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
