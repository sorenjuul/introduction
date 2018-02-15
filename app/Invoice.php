<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;

/**
 * @property string $invoice_no
 * @property string $invoice_due_at
 * @property string $amount
 *
 * @package App
 */
class Invoice extends Model
{
    protected $fillable = [
        'agreement_id', 'invoice_no', 'invoice_due_at', 'amount'
    ];

    public function setInvoiceNoAttribute()
    {
        $this->attributes['invoice_no'] = 0;
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
