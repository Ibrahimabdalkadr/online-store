<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends ApiController
{

    public function index(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => [Rule::in(TicketStatusEnum::namesArray())],
            ]);
            if ($validator->fails()) return $this->errorResponse('validation error',$validator->errors(), Response::HTTP_NOT_FOUND);

            $status = TicketStatusEnum::fromName($request->get('status')) ;

            $tickets = Ticket::where('ticket_status', $status)->orderBy('created_at', 'desc')->get();

            return $this->successResponse('', ['tickets' =>  $tickets]);
        }
        catch (\Exception $e) {
                return $this->errorResponse($e->getMessage());
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'subject' => ['required', 'string'],
            'description' => ['required', 'string'],
            'attachment' => ['base64']
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('validation', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $ticket = Ticket::create([
                'ticket_no'=>'TKT' . Carbon::now()->timestamp . '' . fake()->unique()->numberBetween(10, 99),
                'subject' => $request->subject,
                'description' => $request->description,
                'user_id' => $request->user()->id,
                'attachment'=> $request->attachment,
                'ticket_status' => TicketStatusEnum::pending->value,
            ]);

            return $this->successResponse('Support ticket has been created successfully', [
                'ticket' => $ticket
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show(Ticket $ticket)
    {
        try {
            $messages = $ticket->messages();
            return $this->successResponse('', [
                'ticket' => [
                    $ticket,
                'messages' => $messages
                ]
            ]);
        }catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        try{
        
        }catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        try {
             $ticket->delete();
            return $this->successResponse('deleted successfully', []);
        }catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
