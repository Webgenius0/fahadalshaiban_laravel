<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="billboard-card-details-modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M7.86 2H16.14L22 7.86V16.14L16.14 22H7.86L2 16.14V7.86L7.86 2Z" stroke="#4D4D4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M15 9L9 15" stroke="#4D4D4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 9L15 15" stroke="#4D4D4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="billboard-card">
                <img id="modal-image" src="" alt="Billboard" class="billboard-card-image" />

                    <div class="billboard-card-content">
                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <h3 >Billboard Location</h3>
                                <p class="billboard-card-id" id="modal-name"></p>
                            </div>
                            <button class="campaign-edit-btn">Edit</button>
                        </div>

                        <div>
                            <p class="billboard-card-info-label">Description</p>
                            <p class="billboard-card-info-value" id="modal-description"></p>
                        </div>

                        <div class="billboard-card-info">
                            <div>
                                <span class="billboard-card-info-icon">
                                    <!-- Icon for Views -->
                                </span>
                                <p class="billboard-card-info-label">Estimated views</p>
                                <p class="billboard-card-info-value" id="modal-views"></p>
                            </div>
                            <div>
                                <span class="billboard-card-info-icon">
                                    <!-- Icon for Price -->
                                </span>
                                <p class="billboard-card-info-label">Price per day</p>
                                <p class="billboard-card-info-value" id="modal-price"></p>
                            </div>
                            <div>
                                <span class="billboard-card-info-icon">
                                    <!-- Icon for Rotations -->
                                </span>
                                <p class="billboard-card-info-label">Rotations</p>
                                <p class="billboard-card-info-value" id="modal-rotations"></p>
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
                $('#modal-description').text(response.data.description); 
                $('#modal-id').text('#' + response.id); 
                var baseUrl = window.location.origin; 
                var imageUrl = response.data.image ? baseUrl + '/' + response.data.image : alt='image';

                $('#modal-image').attr('src', imageUrl);
                $('#modal-views').text(response.data.avg_daily_views); 
                $('#modal-price').text(response.data.per_day_price); 
                $('#modal-rotations').text(response.data.rotations); 
                $('#modal-location').text(response.data.location);  

               
                $('#exampleModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);  
            }
        });
    });
});

</script>
@endpush

