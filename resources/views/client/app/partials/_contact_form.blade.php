<section class="py-15 py-lg-18 mt-18 contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <h2 class="mb-11 fs-3">{{TranslateUtility::getTranslate('contact_section', 'top_text', $lang)}}</h2>
                <form class="contact-form" action="" id="contact-form">
                    <div class="row mb-8 mb-md-10">
                        <div class="col-md-6 col-12 mb-8 mb-md-0">
                            <input type="text" autocomplete="name" id="name" class="form-control input-focus" name="name" placeholder="{{TranslateUtility::getTranslate('form', 'name', $lang)}}" />
                        </div>
                        <div class="col-md-6 col-12">
                            <input type="email" autocomplete="email" id="email" name="email" class="form-control input-focus" placeholder="{{TranslateUtility::getTranslate('form', 'email', $lang)}}" />
                        </div>
                    </div>
                    <textarea class="form-control mb-6 input-focus" id="text" name="text" placeholder="{{TranslateUtility::getTranslate('form', 'message', $lang)}}" rows="7"></textarea>

                    <button type="submit" name="contactBtn" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary px-11" id="contactBtn">
                        {{TranslateUtility::getTranslate('form', 'submit', $lang)}}
                    </button>
                </form>
            </div>
            <div class="col-lg-5 ps-lg-18 ps-xl-21 mt-17 contact_det">
                <div class="d-flex align-items-start mb-11 me-15">
                    <div class="d-none">
                        <svg class="icon fs-2">
                            <use xlink:href="#"></use>
                        </svg>
                    </div>
                    <div>
                        <h3 class="fs-5 mb-6">   {{TranslateUtility::getTranslate('site', 'address', $lang)}}</h3>
                        <div class="fs-6">

                            @foreach($addresses as $address)
                                <p class="mb-5 fs-6">
                                    {{$address->getWithLocale($lang)->title ?? ""}}
                                </p>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-start">
                    <div class="d-none">
                        <svg class="icon fs-2">
                            <use xlink:href="#"></use>
                        </svg>
                    </div>
                    <div>
                        <h3 class="fs-5 mb-6">   {{TranslateUtility::getTranslate('site', 'contact', $lang)}}</h3>
                        <div class="fs-6">
                            <p class="mb-3 fs-6">
                                   {{TranslateUtility::getTranslate('site', 'mobile', $lang)}}:<span class="text-body-emphasis">

                                        @foreach($numbers as $number)
                                        <a href="tel:{{$number->data}}">{{$number->data}}</a>@if(!$loop->last),@endif
                                    @endforeach
                                    </span>
                            </p>

                            <p class="mb-0 fs-6">   {{TranslateUtility::getTranslate('site', 'email', $lang)}}: <span class="text-body-emphasis">
                                        @foreach($emails as $email)
                                        <a href="mailto:{{$email->data}}">{{$email->data}}</a>@if(!$loop->last),@endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CONTACT MODAL -->
<div class="modal" id="contactModal" tabindex="-1" aria-labelledby="contactModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-center border-0 pb-0">
                <h3 class="modal-title w-100" id="contactModalLabel">
                    Your application submitted succesfully! We will return you
                    imadiatelly!
                </h3>
            </div>
        </div>
    </div>
</div>
