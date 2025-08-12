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
    <section class="wsus__chat_app">

        @include('messages.layouts.user-list-slidebar')
        <div class="wsus__chat_area">

            <div class="wsus__message_paceholder d-none"></div>

            <div class="wsus__chat_area_header message-header">
                <div class="header_left">
                    <span class="back_to_list">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <img src="images/author_img_2.jpg" alt="User" class="img-fluid">
                    <h4>Jubaydul islam</h4>
                </div>
                <div class="header_right">
                    <a href="#" class="favourite"><i class="fas fa-star"></i></a>
                    <a href="#" class="go_home"><i class="fas fa-home"></i></a>
                    <a href="#" class="info"><i class="fas fa-info-circle"></i></a>
                </div>
            </div>

            <div class="wsus__chat_area_body">

                <div class="wsus__single_chat_area">
                    <div class="wsus__single_chat">
                        <p class="messages">Hi, How are you ?</p>
                        <span class="time"> 5h ago</span>
                        <a class="action" href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

                <div class="wsus__single_chat_area">
                    <div class="wsus__single_chat chat_right">
                        <p class="messages">I'm fine, What about you ?</p>
                        <span class="time"> 5h ago</span>
                        <a class="action" href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

                <div class="wsus__single_chat_area">
                    <div class="wsus__single_chat">
                        <p class="messages">I'm so so</p>
                        <span class="time"> 5h ago</span>
                        <a class="action" href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

                <div class="wsus__single_chat_area">
                    <div class="wsus__single_chat">
                        <p class="messages">You can give a photo ?</p>
                        <span class="time"> 5h ago</span>
                        <a class="action" href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

                <div class="wsus__single_chat_area">
                    <div class="wsus__single_chat chat_right">
                        <p class="messages">Yes</p>
                        <span class="time"> 5h ago</span>
                        <a class="action" href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

                <div class="wsus__single_chat_area">
                    <div class="wsus__single_chat chat_right">
                        <a class="venobox" data-gall="gallery01" href="images/chat_img.png">
                            <img src="images/chat_img.png" alt="gallery1" class="img-fluid w-100">
                        </a>
                        <span class="time"> 5h ago</span>
                        <a class="action" href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

                <div class="wsus__single_chat_area">
                    <div class="wsus__single_chat">
                        <p class="messages">You can give a photo ?</p>
                        <a class="venobox" data-gall="gallery01" href="images/chat_img.png">
                            <img src="images/chat_img.png" alt="gallery1" class="img-fluid w-100">
                        </a>
                        <span class="time"> 5h ago</span>
                        <a class="action" href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

                <div class="wsus__single_chat_area">
                    <div class="wsus__single_chat chat_right">
                        <p class="messages">I'm fine, What about you ?</p>
                        <span class="time"> 5h ago</span>
                        <a class="action" href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

                <div class="wsus__single_chat_area">
                    <div class="wsus__single_chat">
                        <p class="messages">I'm so so</p>
                        <span class="time"> 5h ago</span>
                        <a class="action" href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

                <div class="wsus__single_chat_area">
                    <div class="wsus__single_chat">
                        <p class="messages">You can give a photo ?</p>
                        <span class="time"> 5h ago</span>
                        <a class="action" href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

                <div class="wsus__single_chat_area">
                    <div class="wsus__single_chat chat_right">
                        <p class="messages">Yes</p>
                        <span class="time"> 5h ago</span>
                        <a class="action" href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

                <div class="wsus__single_chat_area">
                    <div class="wsus__single_chat chat_right">
                        <div class="pre_loader">
                            <div class="spinner-border text-light" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <a class="venobox" data-gall="gallery01" href="images/chat_img.png">
                            <img src="images/chat_img.png" alt="gallery1" class="img-fluid w-100">
                        </a>
                        <span class="time"> 5h ago</span>
                        <a class="action" href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

            </div>

            <div class="wsus__chat_area_footer">
                <div class="footer_message">
                    <div class="img d-none attachment-block">
                        <img src="images/chat_img.png" alt="User" class="img-fluid attachment-preview">
                        <span class="cancel-attachment"><i class="far fa-times"></i></span>
                    </div>
                    <form action="#" class="message-form">
                        <div class="file">
                            <label for="file"><i class="far fa-plus"></i></label>
                            <input id="file" type="file" hidden class="attachment-input">
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