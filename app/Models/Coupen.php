<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupen extends Model
{
    use HasFactory;


    // Validation Rules
    public function validations($rules = []) {
        return $rules += [
            'code'  => 'required|unique:categories,title',
            'amount'  => 'required|regex:/^\d+(\.\d{1,2})?$/|min:0|max:300',
            'amount_type'  => 'required|string|max:300',
            'expiry_date'  => 'required|date',
            'status'  => 'required|in:Enable,Disable',
        ];
    }

    // Pass status when want list according to status type
    public function getCoupensList( $status = null ) {
        return Coupen::
        when($status, function($query) use ($status) {
            $query->where('status', '=', $status);
        })
        ->orderBy('id', 'DESC')
        ->get();
    }

    // Get Coupen Detail
    public function getCoupenDetail( $id = null ) {
        return Coupen::
        when($id, function($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();
    }

    // Get Coupen Detail By Code
    public function getCoupenDetailByColumn( $column, $value ) {
        return Coupen::where($column, '=', $value)->where('status', '=', 'Enable')->first();
    }


    // Store Coupen
    public function storeCoupen( $data )
    {
        $coupen = new Coupen;

        $coupen->code         = $data['code'];
        $coupen->name         = $data['name'];
        $coupen->amount       = $data['amount'];
        $coupen->amount_type  = $data['amount_type'];
        $coupen->expiry_date  = $data['expiry_date'];
        $coupen->status      = $data['status'];

        $coupen->save();

        return with($coupen);
    }

    // Update Coupen
    public function updateCoupen( $data )
    {
        $coupen = new Coupen;

        $coupen = $this->getCoupenDetail( $data['coupen_id'] );

        $coupen->code         = $data['code'];
        $coupen->name         = $data['name'];
        $coupen->amount       = $data['amount'];
        $coupen->amount_type  = $data['amount_type'];
        $coupen->expiry_date  = $data['expiry_date'];
        $coupen->status      = $data['status'];

        $coupen->update();

        return with($coupen);
    }

    // Calculate discount
    public function discount( $value, $total )
    {
        $coupen_detail = $this->getCoupenDetailByColumn( 'name', $value );
        
        if ( $coupen_detail->amount_type == 'fixed' ) {
            return $coupen_detail->amount;
        } else if ( $coupen_detail->amount_type == 'percent' ) {
            return ( $coupen_detail->amount / 100 ) * $total;
        } else {
            return 0;
        }
    }
}
