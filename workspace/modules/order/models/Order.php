<?php


namespace workspace\modules\order\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\order\requests\OrderSearchRequest;

class Order extends Model
{
    const DELIVERY_COURIER = 1;
    const DELIVERY_PICKUP = 2;

    protected $table = "order";
    public $fillable = ['city', 'email', 'fio', 'phone', 'pay', 'delivery', 'shop_id', 'delivery_date', 'delivery_time', 'address', 'comment', 'total_price'];

    /**
     * @param OrderSearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(OrderSearchRequest $request)
    {
        $query = self::query();

        if ($request->id) {
            $query->where('id', 'LIKE', "%$request->id%");
        }
        if ($request->fio) {
            $query->where('fio', 'LIKE', "%$request->fio%");
        }
        if ($request->email) {
            $query->where('email', 'LIKE', "%$request->email%");
        }
        if ($request->phone) {
            $query->where('phone', 'LIKE', "%$request->phone%");
        }
        if ($request->delivery) {
            $query->where(['delivery' => $request->delivery]);
        }
        if ($request->delivery_date) {
            $query->where(['delivery_date' => $request->delivery_date]);
        }

        return $query->get();
    }

    public static function getDeliveryTypes()
    {
        return [
            self::DELIVERY_COURIER => 'Курьерская',
            self::DELIVERY_PICKUP => 'Самовывоз',
        ];
    }

}