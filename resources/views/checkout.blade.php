@extends('layouts.yellow.master')

@section('title', 'Checkout')

@push('styles')
<style>
    .form-group {
        margin-bottom: 1rem;
    }
    .card-title {
        margin-bottom: 0.75rem;
    }
    .checkout__totals {
        margin-bottom: 10px;
    }
    .form-control {
        border: 1px solid #d5d5d5;
    }
    .form-control:focus {
        border-color: #ff0000;
        box-shadow: none;
    }
    .btn-primary {
        border-color: #ff0000;
        background-color: #ff0000;
    }
    .input-number .form-control:focus {
        box-shadow: none;
    }
</style>
@endpush

@section('content')
    <div class="checkout block mt-1">
        <div class="container">
            <x-form checkoutform :action="route('checkout')" method="POST">
                @php $user = optional(auth('user')->user()) @endphp
                <div class="row">
                    <div class="col-12 col-md-8 pr-1">
                        <div class="card mb-lg-0">
                            <div class="card-body p-3">
                                <h3 class="card-title">Billing Details</h3>
                                <div class="form-group">
                                    <label class="d-block">Your Name <span class="text-danger">*</span></label>
                                    <x-input name="name" :placeholder="__('checkout.YourName')" :value="$user->name" />
                                    <x-error field="name" />
                                </div>
                                <div class="form-group">
                                    <label class="d-block">Mobile Number <span class="text-danger">*</span></label>
                                    <x-input name="phone" :placeholder="__('checkout.PhoneNumber')" :value="$user->phone_number ?? ''" />
                                    <x-error field="phone" />
                                </div>
                                {{-- <div class="form-group">
                                    <label class="d-block">@lang('checkout.District') <span class="text-danger">*</span></label>
                                    <x-input name="district" :value="$user->district ?? ''" />
                                    <x-error field="district" />
                                </div>
                                <div class="form-group">
                                    <label class="d-block">@lang('checkout.Thana') <span class="text-danger">*</span></label>
                                    <x-input name="thana" :value="$user->thana ?? ''" />
                                    <x-error field="thana" />
                                </div> --}}
                                <div class="form-group">
                                    <label class="d-block">Full Address <span class="text-danger">*</span></label>
                                    <x-textarea name="address" :placeholder="__('checkout.FullAddress')">{{ $user->address }}</x-textarea>
                                    <x-error field="address" />
                                </div>
                                <div class="form-group">
                                    <label class="d-block">@lang('checkout.DeliveryArea') <span class="text-danger">*</span></label>
                                    @php $dcharge = setting('delivery_charge') @endphp
                                    <div class="form-control @error('shipping') is-invalid @enderror h-auto">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="inside-dhaka" name="shipping" value="Inside Dhaka" data-val="{{ $dcharge->inside_dhaka ?? config('services.shipping.Inside Dhaka') }}">
                                            <label class="custom-control-label" for="inside-dhaka">@lang('checkout.InsideDhaka')</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="outside-dhaka" name="shipping" value="Outside Dhaka" data-val="{{ $dcharge->outside_dhaka ?? config('services.shipping.Outside Dhaka') }}">
                                            <label class="custom-control-label" for="outside-dhaka">@lang('checkout.OutsideDhaka')</label>
                                        </div>
                                    </div>
                                    <x-error field="shipping" />
                                </div>
                            </div>
                            <div class="card-divider d-md-none"></div>
                            <div class="card-body d-md-none">
                                <h3 class="card-title mb-0">Your Order</h3>
                                <div class="ordered-products"></div>
                                <table class="checkout__totals">
                                    <tbody class="checkout__totals-subtotals">
                                        <tr>
                                            <th>Subtotal</th>
                                            <td class="checkout-subtotal">{!!  theMoney(0)  !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td class="shipping">{!!  theMoney(0)  !!}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="checkout__totals-footer">
                                        <tr>
                                            <th>Total</th>
                                            <td>{!!  theMoney(0)  !!}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="checkout__agree form-group">
                                    <div class="form-check">
                                        <span class="form-check-input input-check">
                                            <span class="input-check__body">
                                                <input class="input-check__input" type="checkbox" id="checkout-terms" checked>
                                                <span class="input-check__box"></span>
                                                <svg class="input-check__icon" width="9px" height="7px">
                                                    <use xlink:href="{{ asset('strokya/images/sprite.svg#check-9x7') }}"></use>
                                                </svg>
                                            </span>
                                        </span>
                                        <label class="form-check-label" for="checkout-terms">I agree to the <span class="text-info" target="_blank" href="javascript:void(0);">terms and conditions</span>*</label>
                                    </div>
                                </div>
                                <button type="submit" place-order class="btn btn-primary btn-xl btn-block text-white">Confirm Order</button>
                            </div>
                            <div class="card-divider"></div>
                            <div class="card-body p-1">
                                <h4 class="p-2">Product Overview</h4>
                                @include('partials.cart-table')
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-12 col-md-4 pl-1 mt-4 mt-lg-0">
                        <div class="card mb-0">
                            <div class="card-body">
                                <h3 class="card-title">Your Order</h3>
                                <div class="ordered-products"></div>
                                <table class="checkout__totals">
                                    <tbody class="checkout__totals-subtotals">
                                        <tr>
                                            <th>Subtotal</th>
                                            <td class="checkout-subtotal desktop">{!!  theMoney(0)  !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td class="shipping">{!!  theMoney(0)  !!}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="checkout__totals-footer">
                                        <tr>
                                            <th>Total</th>
                                            <td>{!!  theMoney(0)  !!}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="d-none d-md-block">
                                    <div class="checkout__agree form-group">
                                        <div class="form-check">
                                            <span class="form-check-input input-check">
                                                <span class="input-check__body">
                                                    <input class="input-check__input" type="checkbox" id="checkout-terms" checked>
                                                    <span class="input-check__box"></span>
                                                    <svg class="input-check__icon" width="9px" height="7px">
                                                        <use xlink:href="{{ asset('strokya/images/sprite.svg#check-9x7') }}"></use>
                                                    </svg>
                                                </span>
                                            </span>
                                            <label class="form-check-label" for="checkout-terms">I agree to the <span class="text-info" target="_blank" href="javascript:void(0);">terms and conditions</span>*</label>
                                        </div>
                                    </div>
                                    <button type="submit" place-order class="btn btn-primary btn-xl btn-block text-white">Confirm Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('[place-order]').on('click', function (ev) {
            if ($(this).hasClass('disabled')) {
                ev.preventDefault();
            }
            $(this).text('Processing..').css('opacity', 1).addClass('disabled');
        });
    });
</script>
@endpush