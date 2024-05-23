@extends('layouts.master')

@section('title', 'Feed Back')
@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <style>
        .background_color {
            background: white;
        }
    </style>
@endsection

@section('content')

    <div id="pagee" class="clearfix">
        <section style="min-height: 87vh" class="background_color flat-contact tf-section  relative">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 ml-auto mr-auto" style="margin-top:5vh;">
                        <div class="wrap-contact">
                            <div class="box-title flex justify-space">
                                <div class="inner">
                                    <div class="title-ct fs-30 fw-7">Feed Back </div>

                                </div>
                                <div class="icon-message animate-zoom">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M33.8668 1.7959H18.0927C15.6302 1.7959 13.6269 3.79882 13.6269 6.26215V14.193H6.12893C3.6681 14.1934 1.66602 16.1963 1.66602 18.6571V28.5738C1.66602 31.0347 3.6681 33.038 6.12893 33.038H6.82768V36.1263C6.82768 36.9651 7.30518 37.6959 8.07393 38.0305C8.34143 38.1472 8.62477 38.2042 8.9056 38.2042C9.43297 38.2041 9.94074 38.0043 10.3268 37.6451L15.2314 33.038H21.9077C24.3694 33.038 26.3718 31.0351 26.3718 28.5738V22.1421L29.6752 25.2367C29.9697 25.5146 30.3394 25.6999 30.7382 25.7695C31.1371 25.8391 31.5477 25.7901 31.9189 25.6284C32.2904 25.4677 32.6068 25.2018 32.8289 24.8634C33.051 24.525 33.1692 24.129 33.1689 23.7242V20.6446H33.8673C36.3293 20.6451 38.3327 18.6417 38.3327 16.1788V6.26215C38.3327 3.79923 36.3293 1.7959 33.8668 1.7959ZM21.9077 30.7838H14.7856C14.4989 30.7841 14.223 30.8934 14.0139 31.0896L9.08185 35.7234V31.9109C9.0819 31.7629 9.05279 31.6163 8.99617 31.4795C8.93954 31.3428 8.85653 31.2185 8.75186 31.1138C8.64719 31.0091 8.52292 30.9261 8.38615 30.8695C8.24938 30.8129 8.10279 30.7838 7.95477 30.7838H6.12893C5.54312 30.7832 4.98151 30.5501 4.5674 30.1357C4.15329 29.7214 3.92051 29.1596 3.92018 28.5738V18.6571C3.92051 18.0713 4.15329 17.5096 4.5674 17.0952C4.98151 16.6809 5.54312 16.4478 6.12893 16.4471H13.6406C13.7806 18.7851 15.721 20.6451 18.0927 20.6451H24.1173V28.5738C24.1169 29.1598 23.884 29.7216 23.4698 30.136C23.0555 30.5504 22.4936 30.7834 21.9077 30.7838ZM36.0785 16.1788C36.0779 16.7652 35.8446 17.3274 35.43 17.7421C35.0154 18.1568 34.4533 18.3901 33.8668 18.3909H32.0414C31.8934 18.3908 31.7468 18.42 31.6101 18.4766C31.4733 18.5332 31.349 18.6162 31.2443 18.7209C31.1397 18.8256 31.0567 18.9498 31 19.0866C30.9434 19.2234 30.9143 19.37 30.9144 19.518V23.3109L26.0218 18.7192L25.9985 18.6971L25.9956 18.7005L25.9898 18.6951C25.7808 18.4995 25.5051 18.3909 25.2189 18.3913H18.0927C17.5063 18.3905 16.9441 18.1572 16.5295 17.7425C16.1149 17.3278 15.8817 16.7656 15.881 16.1792V16.1771H15.8893L15.881 6.26298C15.8817 5.67658 16.1149 5.11437 16.5295 4.69968C16.9441 4.28499 17.5063 4.05167 18.0927 4.0509H33.8668C34.4533 4.05167 35.0154 4.28499 35.43 4.69968C35.8446 5.11437 36.0779 5.67658 36.0785 6.26298V16.1788Z"
                                            fill="#FF9700" />
                                        <path
                                            d="M30.4872 7.77051H21.4713C21.1724 7.77051 20.8857 7.88925 20.6744 8.10062C20.463 8.31199 20.3442 8.59867 20.3442 8.89759C20.3442 9.19651 20.463 9.48319 20.6744 9.69456C20.8857 9.90593 21.1724 10.0247 21.4713 10.0247H30.4876C30.6356 10.0246 30.7821 9.99547 30.9189 9.9388C31.0556 9.88213 31.1798 9.79909 31.2845 9.69441C31.3891 9.58973 31.4721 9.46547 31.5287 9.32871C31.5854 9.19196 31.6145 9.04539 31.6145 8.89738C31.6144 8.74937 31.5852 8.60282 31.5286 8.46608C31.4719 8.32935 31.3889 8.20512 31.2842 8.10048C31.1795 7.99584 31.0553 7.91284 30.9185 7.85622C30.7817 7.79961 30.6352 7.77048 30.4872 7.77051ZM30.4872 12.2784H21.4713C21.1724 12.2784 20.8857 12.3972 20.6744 12.6085C20.463 12.8199 20.3442 13.1066 20.3442 13.4055C20.3442 13.7044 20.463 13.9911 20.6744 14.2025C20.8857 14.4138 21.1724 14.5326 21.4713 14.5326H30.4876C30.6356 14.5326 30.7821 14.5034 30.9189 14.4467C31.0556 14.3901 31.1798 14.307 31.2845 14.2023C31.3891 14.0976 31.4721 13.9734 31.5287 13.8366C31.5854 13.6999 31.6145 13.5533 31.6145 13.4053C31.6144 13.2573 31.5852 13.1107 31.5286 12.974C31.4719 12.8373 31.3889 12.713 31.2842 12.6084C31.1795 12.5038 31.0553 12.4208 30.9185 12.3641C30.7817 12.3075 30.6352 12.2784 30.4872 12.2784ZM9.52049 22.5163C9.38549 22.5605 9.27258 22.6505 9.16008 22.7409C8.95716 22.9655 8.82174 23.2605 8.82174 23.553C8.82174 23.8455 8.95674 24.1384 9.16008 24.3409C9.38549 24.5655 9.65591 24.6801 9.94883 24.6801C10.1063 24.6801 10.2647 24.6338 10.3997 24.5897C10.5351 24.5434 10.6476 24.453 10.7601 24.3409C10.963 24.1384 11.0984 23.8455 11.0984 23.553C11.0984 23.2605 10.963 22.9651 10.7601 22.7409C10.4447 22.4484 9.94883 22.3359 9.52049 22.5163ZM14.9076 22.5163C14.4792 22.3359 13.9834 22.448 13.668 22.7409C13.4651 22.9655 13.3526 23.2605 13.3526 23.553C13.3526 23.8455 13.4651 24.1384 13.668 24.3409C13.7805 24.453 13.8934 24.5434 14.0284 24.5897C14.1863 24.6338 14.3213 24.6801 14.4792 24.6801C14.7726 24.6801 15.043 24.5655 15.2684 24.3409C15.4713 24.1384 15.6067 23.8455 15.6067 23.553C15.6067 23.2605 15.4713 22.9651 15.2684 22.7409C15.1555 22.6509 15.043 22.5605 14.9076 22.5163ZM19.4159 22.5163C19.1455 22.4018 18.8297 22.4018 18.5367 22.5163C18.4017 22.5605 18.2888 22.6505 18.1763 22.7409C17.9734 22.9655 17.838 23.2605 17.838 23.553C17.838 23.8455 17.973 24.1384 18.1763 24.3409C18.4017 24.5655 18.6722 24.6801 18.9655 24.6801C19.123 24.6801 19.2809 24.6338 19.4163 24.5897C19.5517 24.5434 19.6642 24.453 19.7772 24.3409C19.9801 24.1384 20.0926 23.8455 20.0926 23.553C20.0926 23.2605 19.9797 22.9651 19.7772 22.7409C19.6638 22.6509 19.5513 22.5605 19.4159 22.5163ZM7.70716 11.1518H9.96133C10.2602 11.1518 10.5469 11.033 10.7583 10.8216C10.9697 10.6103 11.0884 10.3236 11.0884 10.0247C11.0884 9.72575 10.9697 9.43908 10.7583 9.22771C10.5469 9.01634 10.2602 8.89759 9.96133 8.89759H7.70716C7.40824 8.89759 7.12156 9.01634 6.91019 9.22771C6.69882 9.43908 6.58008 9.72575 6.58008 10.0247C6.58008 10.3236 6.69882 10.6103 6.91019 10.8216C7.12156 11.033 7.40824 11.1518 7.70716 11.1518ZM32.5013 29.1838H30.2472C29.9482 29.1838 29.6616 29.3026 29.4502 29.514C29.2388 29.7253 29.1201 30.012 29.1201 30.3109C29.1201 30.6098 29.2388 30.8965 29.4502 31.1079C29.6616 31.3193 29.9482 31.438 30.2472 31.438H32.5013C32.8003 31.438 33.0869 31.3193 33.2983 31.1079C33.5097 30.8965 33.6284 30.6098 33.6284 30.3109C33.6284 30.012 33.5097 29.7253 33.2983 29.514C33.0869 29.3026 32.8003 29.1838 32.5013 29.1838Z"
                                            fill="#FF9700" />
                                    </svg>
                                </div>
                            </div>
                            <div id="comments" class="comments">
                                <div class="respond-comment">

                                    <form method="post" class="comment-form form-submit"
                                        action="{{ route('send_feedback') }}" accept-charset="utf-8"
                                        novalidate="novalidate">
                                        @csrf
                                        <p>@lang('lang.reach out, share your feedback, help us do better.')</p>

                                        <fieldset class="message-wrap" style="margin-top:20px ">
                                            <label class="font-2 fw-8 fs-16">@lang('lang.message')</label>
                                            <textarea id="comment-message" name="message" rows="4" tabindex="4" placeholder="@lang('lang.your message')"
                                                aria-required="true"></textarea>
                                        </fieldset>
                                        <div class="button-boxs">

                                            <button class="sc-button btn-icon" name="submit" type="submit">
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_1505_28737)">
                                                        <path
                                                            d="M17.7381 0.0295345L0.899726 5.53166C0.424186 5.68706 0.355417 6.33388 0.788208 6.58552L7.1516 10.2857C7.24979 10.3428 7.36258 10.3699 7.47599 10.3635C7.5894 10.3572 7.69846 10.3177 7.78965 10.2499L9.57844 8.92152L8.25002 10.7103C8.1823 10.8015 8.14281 10.9106 8.13645 11.024C8.13009 11.1374 8.15714 11.2502 8.21424 11.3484L11.9144 17.7118C12.1664 18.1449 12.813 18.0754 12.9683 17.6003L18.4705 0.76186C18.618 0.309727 18.1881 -0.117584 17.7381 0.0295345ZM12.2669 16.0078L9.41045 11.0954L12.8548 6.45741C12.9378 6.34558 12.9779 6.20763 12.9676 6.06873C12.9574 5.92984 12.8976 5.79924 12.7991 5.70076C12.7006 5.60228 12.57 5.54247 12.4311 5.53225C12.2923 5.52203 12.1543 5.56207 12.0425 5.64507L7.40447 9.08947L2.49215 6.233L17.0112 1.48874L12.2669 16.0078ZM6.59633 12.7247L2.74099 16.58C2.51425 16.8067 2.1466 16.8068 1.91987 16.58C1.69309 16.3533 1.69309 15.9856 1.91987 15.7589L5.77521 11.9036C6.00202 11.6769 6.36967 11.6768 6.59633 11.9036C6.82311 12.1303 6.82311 12.498 6.59633 12.7247ZM1.50311 12.8706C1.27634 12.6438 1.27634 12.2762 1.50311 12.0495L3.02438 10.5282C3.25112 10.3014 3.61877 10.3014 3.8455 10.5282C4.07228 10.7549 4.07228 11.1226 3.8455 11.3493L2.32424 12.8706C2.09754 13.0973 1.72985 13.0973 1.50311 12.8706ZM7.97175 14.6544C8.19852 14.8811 8.19852 15.2488 7.97175 15.4755L6.45045 16.9968C6.3966 17.0508 6.33261 17.0936 6.26215 17.1228C6.1917 17.152 6.11617 17.167 6.0399 17.1669C5.52724 17.1669 5.26254 16.5424 5.62936 16.1756L7.15066 14.6544C7.37736 14.4276 7.74501 14.4276 7.97175 14.6544Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_1505_28737">
                                                            <rect width="18" height="18" fill="white"
                                                                transform="translate(0.5)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                <span>@lang('lang.send')</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>

    </div>
@endsection

@section('additional_scripts')
    @if (session('status'))
        <script>
            alert('{{ session('status') }}');
        </script>
    @endif
@endsection
