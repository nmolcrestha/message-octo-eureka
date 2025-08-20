@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/venobox.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/emojionearea.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
@endpush

@push('scripts')
<!--jquery library js-->
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<!--bootstrap js-->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!--font-awesome js-->
<script src="{{ asset('assets/js/Font-Awesome.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/venobox.min.js') }}"></script>
<script src="{{ asset('assets/js/emojionearea.min.js') }}"></script>

<!--main/custom js-->
<script src="{{ asset('assets/js/main.js') }}"></script>
@endpush

<x-app-layout>
    <section class="wsus__chat_app show_info">

        @include('messages.layouts.user-list-slidebar')
        <div class="wsus__chat_area">

            <div class="wsus__message_paceholder d-none"></div>
            <div class="wsus__message_paceholder_blank d-flex justify-content-center align-items-center">
                <span class="select_a_user">Select a user to start conversation</span>
            </div>

            <div class="wsus__chat_area_header message-header">
                <div class="header_left">
                    <span class="back_to_list">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <img src="" alt="User" class="img-fluid">
                    <h4></h4>
                </div>
                <div class="header_right">
                    <a href="#" class="favourite active"><i class="fas fa-star"></i></a>
                    <a href="#" class="go_home"><i class="fas fa-home"></i></a>
                    <a href="#" class="info"><i class="fas fa-info-circle"></i></a>
                </div>
            </div>

            <div class="wsus__chat_area_body">

            </div>

            <div class="wsus__chat_area_footer">
                <div class="footer_message">
                    <div class="img d-none attachment-block">
                        <img src="images/chat_img.png" alt="User" class="img-fluid attachment-preview">
                        <span class="cancel-attachment"><i class="far fa-times"></i></span>
                    </div>
                    <form action="#" class="message-form" enctype="multipart/form-data">
                        <div class="file">
                            <label for="file"><i class="far fa-plus"></i></label>
                            <input id="file" type="file" hidden class="attachment-input" name="attachment" accept="image/*">
                        </div>
                        <textarea id="example1" rows="1" placeholder="Type a message.." name="message" class="message-input"></textarea>
                        <button><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>

        @include('messages.layouts.user-info-sidebar')

    </section>

</x-app-layout>