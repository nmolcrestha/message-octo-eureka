<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="#" class="profile-form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    @csrf
                    <div class="file profile-file">
                        <img src="{{ asset(auth()->user()->avatar) }}" alt="Upload"
                            class="img-fluid profile-image-preview">
                        <label for="select_file"><i class="fal fa-camera-alt"></i></label>
                        <input id="select_file" type="file" name="avatar" hidden>
                    </div>
                    <p>Edit information</p>
                    <input type="text" placeholder="Name" value="{{ auth()->user()->name }}" name="name">
                    <input type="text" placeholder="Username" value="{{ auth()->user()->user_name }}" name="user_name">
                    <input type="email" placeholder="Email" value="{{ auth()->user()->email }}" name="email">
                    <p>Change password</p>
                    <div class="row">
                        <div class="col-xl-6">
                            <input type="password" placeholder="Current Password" name="current_password">
                        </div>
                        <div class="col-xl-6">
                            <input type="password" placeholder="New Password" name="password">
                        </div>
                        <div class="col-xl-12">
                            <input type="password" placeholder="Confirm Password" name="password_confirmation">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save save-profile">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        $('.profile-form').on('submit', function(e) {
            e.preventDefault();
            let saveBtn = $('.save-profile');
            let formData = new FormData(this);
           $.ajax({
                url: "{{ route('message.profile.update') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                   saveBtn.text('Saving...');
                   saveBtn.prop("disabled", true);
                },
                success: function(data) {
                   window.location.reload();
                },
                error: function(xhr, status, error) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(index, value) {
                        notyf.error(value[0]);
                    });
                    saveBtn.text('Save changes');
                    saveBtn.prop("disabled", false);
                }
            });
        });
    })

</script>
@endpush