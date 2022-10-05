<div class="site-header__topbar topbar">
    <div class="topbar__container container">
        <div class="topbar__row">
            <div class="topbar__item topbar__item--link mr-2">
                <img style="height: 35px;" class="img-responsive " src="https://www.himelshop.com/front_asset/call-now.gif" alt="Call 7colors" title="7colors">&nbsp;
                <a class="topbar-phone" style="font-family: monospace; font-size: 20px; color: #ff0000" class="topbar-link" href="tel:{{ $company->phone ?? '' }}">{{ $company->phone ?? '' }}</a>
            </div>
            @foreach($menuItems as $item)
            <div class="topbar__item topbar__item--link d-none d-md-flex">
                <a class="topbar-link" href="{{ url($item->href) }}">{!! $item->name !!}</a>
            </div>
            @endforeach
            <div class="topbar__spring w-100">
                <marquee class="d-flex align-items-center h-100" behavior="" direction="">{!! $scroll_text ?? '' !!}</marquee>
            </div>
            <ul class="d-none d-md-flex footer-newsletter__social-links m-0 mx-1">
                <li class="footer-newsletter__social-link footer-newsletter__social-link--phone ml-1">
                    <a href="mailto:{{$company->email}}" target="_blank" class="bg-secondary">
                        <i class="fas fa-envelope"></i>
                    </a>
                </li>
                @foreach($social ?? [] as $item => $data)
                    @if($data->display ?? false)
                    <li class="footer-newsletter__social-link footer-newsletter__social-link--{{ $item }} ml-1">
                        <a href="{{ url($data->link ?? '#') }}" target="_blank">
                            @switch($item)
                                @case('facebook')
                                <i class="fab fa-facebook-f"></i>
                                @break
                                @case('twitter')
                                <i class="fab fa-twitter"></i>
                                @break
                                @case('instagram')
                                <i class="fab fa-instagram"></i>
                                @break
                                @case('youtube')
                                <i class="fab fa-youtube"></i>
                                @break
                            @endswitch
                        </a>
                    </li>
                    @endif
                @endforeach
            </ul>
            <div class="topbar__item topbar__item--link ml-1">
                <a class="topbar-link" href="{{ url('/track-order') }}">Track Order</a>
            </div>
        </div>
    </div>
</div>