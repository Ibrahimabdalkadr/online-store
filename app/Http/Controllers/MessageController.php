<?php

namespace App\Http\Controllers;

use App\Events\SupportMessageSent;
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
            'ticket_no' => ['required', 'string'],
            'body' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return $this->errorResponse('validation', $validator->errors(), 422);
        }

        try {
        $ticket = Ticket::where('ticket_no', $request->ticket_no)->first();
        if (!$ticket)  return $this->errorResponse('Ticket not found', [], 404);

        $senderId = auth()->id();
        if ($ticket->user_id === auth()->id()) {
            $receiverId = $ticket->assignedTo->id;
        } else {
            $receiverId = $ticket->ticket->user_id;
        }

        $message = $ticket->messages()->create([
            'body' => $request->body,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
        ]);

        event(new SupportMessageSent($message));

        return $this->successResponse('Message sent successfully', [
            'message' => $message
        ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show(Ticket $ticket)
    {
        try {
           $messages = $ticket->messages();
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
