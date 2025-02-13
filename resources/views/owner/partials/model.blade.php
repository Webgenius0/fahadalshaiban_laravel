<div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div
        class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button
                    type="button"
                    class="billboard-card-details-modal-close-btn"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M7.86 2H16.14L22 7.86V16.14L16.14 22H7.86L2 16.14V7.86L7.86 2Z"
                            stroke="#4D4D4D"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M15 9L9 15"
                            stroke="#4D4D4D"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M9 9L15 15"
                            stroke="#4D4D4D"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="billboard-card">
                <img id="modal-image" src="" alt="Billboard" class="billboard-card-image" />
                    <div class="billboard-card-content">
                        <div
                            class="d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <h3>Billboard Location</h3>
                                <p class="billboard-card-id" id="modal-name"></p>
                            </div>
                            <div id="editSignage"></div>
                        </div>

                        <div>
                            <p class="billboard-card-info-label">Description</p>
                            <p class="billboard-card-info-value" id="modal-description"></p>
                        </div>

                        <div class="billboard-card-info">
                            <div>
                                <span class="billboard-card-info-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"
                                            stroke="#4D4D4D"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                            stroke="#4D4D4D"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <p class="billboard-card-info-label">Estimated views</p>
                                <p class="billboard-card-info-value" id="modal-views"></p>
                            </div>
                            <div>
                                <span class="billboard-card-info-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M12 1V23"
                                            stroke="#4D4D4D"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M17 5H9.5C8.57174 5 7.6815 5.36875 7.02513 6.02513C6.36875 6.6815 6 7.57174 6 8.5C6 9.42826 6.36875 10.3185 7.02513 10.9749C7.6815 11.6313 8.57174 12 9.5 12H14.5C15.4283 12 16.3185 12.3687 16.9749 13.0251C17.6313 13.6815 18 14.5717 18 15.5C18 16.4283 17.6313 17.3185 16.9749 17.9749C16.3185 18.6313 15.4283 19 14.5 19H6"
                                            stroke="#4D4D4D"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <p class="billboard-card-info-label">Price per day</p>
                                <p class="billboard-card-info-value" id="modal-price"></p>
                            </div>
                            <div>
                                <span class="billboard-card-info-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                            stroke="#4D4D4D"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 6V12L16 14"
                                            stroke="#4D4D4D"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <p class="billboard-card-info-label">Rotations</p>
                                <p class="billboard-card-info-value" id="modal-rotations"></p>
                            </div>
                            <div>
                                <span class="billboard-card-info-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M5 17H4C3.46957 17 2.96086 16.7893 2.58579 16.4142C2.21071 16.0391 2 15.5304 2 15V5C2 4.46957 2.21071 3.96086 2.58579 3.58579C2.96086 3.21071 3.46957 3 4 3H20C20.5304 3 21.0391 3.21071 21.4142 3.58579C21.7893 3.96086 22 4.46957 22 5V15C22 15.5304 21.7893 16.0391 21.4142 16.4142C21.0391 16.7893 20.5304 17 20 17H19"
                                            stroke="#4D4D4D"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 15L17 21H7L12 15Z"
                                            stroke="#4D4D4D"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <p class="billboard-card-info-label">Display size</p>
                                <p class="billboard-card-info-value" id="modal-display-size">
                                    
                                </p>
                            </div>
                            <div>
                                <span class="billboard-card-info-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M5 17H4C3.46957 17 2.96086 16.7893 2.58579 16.4142C2.21071 16.0391 2 15.5304 2 15V5C2 4.46957 2.21071 3.96086 2.58579 3.58579C2.96086 3.21071 3.46957 3 4 3H20C20.5304 3 21.0391 3.21071 21.4142 3.58579C21.7893 3.96086 22 4.46957 22 5V15C22 15.5304 21.7893 16.0391 21.4142 16.4142C21.0391 16.7893 20.5304 17 20 17H19"
                                            stroke="#4D4D4D"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 15L17 21H7L12 15Z"
                                            stroke="#4D4D4D"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <p class="billboard-card-info-label">Location</p>
                                <p class="billboard-card-info-value" id="modal-location"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
$(document).ready(function() {   
    $('button.campaign-edit-btn').click(function() {
        var id = $(this).data('id'); 

        $.ajax({
            url: "{{ route('owner.signage.show', ':id') }}".replace(':id', id), 
            method: 'GET',
            success: function(response) {
                console.log(response);               
                $('#modal-name').text(response.data.name);  
                $('#modal-description').text(response.data.description.replace(/<\/?[^>]+(>|$)/g, "")); 
                
                const url = "{{ route('owner.signage.edit', ':id') }}".replace(':id', response.data.id);
                $('#editSignage').html(`<button onclick="window.location.href='${url}'" class="campaign-edit-btn edit-signage" id="modal-id">Edit</button>`);



                var baseUrl = window.location.origin; 
                var imageUrl = response.data.image ? baseUrl + '/' + response.data.image : defaultImage;

                $('#modal-image').attr('src', imageUrl);
                $('#modal-views').text(response.data.avg_daily_views); 
                $('#modal-price').text(response.data.per_day_price); 
                $('#modal-rotations').text(response.data.exposure_time); 
                $('#modal-location').text(response.data.location);  
                $('#modal-display-size').text(response.data.display_size); 

               
                $('#exampleModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);  
            }
        });
    });
});

//edit-signage




</script>
@endpush