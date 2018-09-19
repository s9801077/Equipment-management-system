<?php

namespace App\Http\Controllers;

use App\Http\Requests\TelegramMessageRequest;
use App\TelegramMessage;
use Illuminate\Http\Request;

class TelegramMessageController extends Controller
{
    use ApiTrait;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $channel_id = $request->input('channel_id', 0);
        $search = $request->input('search', '');
        $order_field = $request->input('orderby_field', 'id');
        $order_method = $request->input('orderby_method', 'desc');
        $limit = $request->input('limit', 25);

        $telegramMessages = TelegramMessage::where(function ($query) use ($search, $channel_id) {
            if ($channel_id) {
                $query->where('channel_id', $channel_id);
            }

            if ($search) {
                $query->where('display_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('content', 'LIKE', '%' . $search . '%');
            }
        })
            ->orderBy($order_field, $order_method)
            ->paginate($limit);

        return $this->returnSuccess('Success.', $telegramMessages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TelegramMessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TelegramMessageRequest $request)
    {
        $data = $request->only(["sending_time", "channel_id", "display_name", "content"]);
        $data['user_id'] = auth()->id();

        return $this->returnSuccess("Success", TelegramMessage::create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TelegramMessage  $telegramMessage
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(TelegramMessage $telegramMessage)
    {
        return $this->returnSuccess("Success", $telegramMessage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TelegramMessageRequest $request
     * @param  \App\TelegramMessage  $telegramMessage
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TelegramMessageRequest $request, TelegramMessage $telegramMessage)
    {
        if ($telegramMessage->isSend()) {
            return $this->return400Response("訊息已發送，無法變更。");
        }

        return $this->returnSuccess(
            "Success",
            $telegramMessage->update($request->only(["sending_time", "channel_id", "display_name", "content"]))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TelegramMessage $telegramMessage
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(TelegramMessage $telegramMessage)
    {
        if ($telegramMessage->isSend()) {
            return $this->return400Response("訊息已發送，無法刪除。");
        }

        return $this->returnSuccess("Success", $telegramMessage->delete());
    }
}