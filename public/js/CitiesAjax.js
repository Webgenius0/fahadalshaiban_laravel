// resources/js/dynamic-dropdown.js

$(document).ready(function() {
    // Try to fetch data from the API first
    // $.ajax({
    //     url: '/api/saudi-cities', // Replace with your actual API endpoint
    //     type: 'GET',
    //     success: function(response) {
    //         // If the API call is successful, use the data
    //         console.log('API data:', response);
    //         const cities = response.cities; // Assuming the response contains the 'cities' array
    //         populateDropdown(cities);
    //     },
    //     error: function(xhr, status, error) {
    //         console.error("API failed, loading from local JSON:", error);
            
    //         // If the API fails, load cities from a local JSON file
    //         $.ajax({
    //             url: 'cities.json',  // Path to your local JSON file
    //             type: 'GET',
    //             success: function(response) {
    //                 console.log('Loaded from local JSON:', response);
    //                 const cities = response.cities;  // Assuming the JSON has a 'cities' array
    //                 populateDropdown(cities);
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error("Both API and local JSON failed:", error);
    //             }
    //         });
    //     }
    // });

                $.ajax({
                    url: '/js/Cities.json',  
                    type: 'GET',
                    success: function(response) {
                        console.log('Loaded from local JSON:', response);
                        const cities = response.cities;  
                        populateDropdown(cities);
                    },
                    error: function(xhr, status, error) {
                        console.error("JSON failed:", error);
                    }
                });
                // Function to populate the dropdown with city options
                function populateDropdown(cities) {
                    const dropdown = $('#cities');
                    dropdown.empty();  
                    dropdown.append('<option data-display="Location">Select Cities..</option>');  
                    
                    cities.forEach(function(city) {
                        dropdown.append('<option value="' + city.toLowerCase() + '">' + city + '</option>');
                    });
                }

                // function populateDropdown(cities, oldCity) {
                //     const dropdown = $('#cities');
                //     dropdown.empty();  // Clear any existing options
                //     dropdown.append('<option value="">Select Location...</option>');  // Default option
                
                //     cities.forEach(function(city) {
                //         const cityValue = city.toLowerCase();  // Standardize to lowercase for comparison
                //         const selected = cityValue === oldCity.toLowerCase() ? 'selected' : '';  // Check if it matches the old value
                
                //         // Append the option with the correct value and the selected attribute
                //         dropdown.append('<option value="' + cityValue + '" ' + selected + '>' + city + '</option>');
                //     });
                // }
            });
