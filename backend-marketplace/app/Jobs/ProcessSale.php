<?php

namespace App\Jobs;

use App\Models\Sale;
use App\Models\UserSkin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSale implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected array $skinIds,
        protected $user
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $skins = UserSkin::with('user', 'skin')->whereIn('id', $this->skinIds)->get();

        $totalPrice = $skins->sum('price');

        $buyerCredits = $this->user->credits;

        if ($buyerCredits >= $totalPrice) {
            $this->user->decrement('credits', $totalPrice);

            foreach ($skins as $skin) {
                $seller = $skin->user;
                $seller->increment('credits', $skin->price);

                Sale::create([
                    'seller_id' => $seller->id,
                    'buyer_id' => $this->user->id,
                    'skin_id' => $skin->skin->id,
                    'price' => $skin->price,
                ]);
            }

            UserSkin::whereIn('id', $this->skinIds)->update([
                'user_id' => $this->user->id,
                'for_sale' => false
            ]);
        } else {
            //
        }
    }
}
