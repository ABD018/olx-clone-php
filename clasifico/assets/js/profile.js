document.addEventListener('DOMContentLoaded', function() {
    const profileForm = document.querySelector('#profile-form');

    // Fetch user profile data on page load
    fetch('controller/userController.php?action=fetchProfile')
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('name').value = data.name || '';
                document.getElementById('email').value = data.email || '';
                document.getElementById('address').value = data.address || '';
                document.getElementById('phone_number').value = data.phone || '';
            }
        })
        .catch(error => console.error('Error fetching profile:', error));

    profileForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const address = document.getElementById('address').value.trim();
        const phone = document.getElementById('phone_number').value.trim();

        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('address', address);
        formData.append('phone_number', phone);

        fetch('controller/userController.php?action=updateProfile', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Profile updated successfully');
            } else {
                alert(data.error || 'Update failed');
            }
        })
        .catch(error => console.error('Error updating profile:', error));
    });
});



//submit ad 

document.addEventListener('DOMContentLoaded', function() {
    const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
    const contentSections = document.querySelectorAll('.content-section');
    const submitAdForm = document.getElementById('submitAdForm');
    const fileInput = document.getElementById('reference_images');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const categoryButton = document.getElementById('adCategoryButton');
    const categoryDropdownItems = document.querySelectorAll('.dropdown-menu .dropdown-item');
    let selectedCategory = '';
    let selectedFiles = []; // Array to keep track of all selected files
    const selectedFilesData = document.getElementById('selectedFilesData'); // Hidden input field

    // Handle category selection
    categoryDropdownItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            selectedCategory = this.getAttribute('data-value');
            categoryButton.textContent = selectedCategory;
        });
    });

    // Function to fetch and display ads
    function fetchAds() {
        fetch('controller/userController.php?action=getAds')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("hi");
                    const cardDeck = document.getElementById('listings-cards');
                    cardDeck.innerHTML = ''; // Clear existing ads
                    data.ads.forEach((ad, index) => {
                        const newCard = document.createElement('div');
                        newCard.className = 'col-lg-4 col-md-6 col-sm-12 feature-block';
    
                        // Create ad block HTML
                        newCard.innerHTML = `
                            <div class="feature-block-one wow fadeInDown animated animated" data-wow-delay="${index * 300}ms" data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="${ad.adImageUrl}" alt="${ad.title}" style="width: 100%; height: auto; object-fit: cover;"></figure>
                                        <div class="shape"></div>
                                        <div class="feature">Featured</div>
                                        <div class="icon">
                                            <div class="icon-shape"></div>
                                            <i class="${ad.iconClass}"></i>
                                        </div>
                                    </div>
                                    <div class="lower-content">
                                        <div class="author-box">
                                            <div class="inner">
                                                <img src="${ad.authorImageUrl}" alt="${ad.authorName}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; margin-right: 10px;">
                                                <h6>${ad.authorName}<i class="icon-18"></i></h6>
                                                <span>${ad.authorRole}</span>
                                            </div>
                                        </div>
                                        <div class="category"><i class="fas fa-tags"></i><p>${ad.category}</p></div>
                                        <h3><a href="browse-ads-details.php?id=${ad.id}">${ad.title}</a></h3>
                                        <ul class="rating clearfix">
                                            ${'<li><i class="icon-17"></i></li>'.repeat(ad.rating)}
                                            <li><a href="index.php">(${ad.ratingCount})</a></li>
                                        </ul>
                                        <ul class="info clearfix">
                                            <li><i class="far fa-clock"></i>${ad.timeAgo}</li>
                                            <li><i class="fas fa-map-marker-alt"></i>${ad.location}</li>
                                        </ul>
                                        <div class="lower-box">
                                            <h5><span>Start From:</span>₹${ad.price}</h5>
                                            <ul class="react-box">
                                                <li><a href="index.php"><i class="icon-21"></i></a></li>
                                                <li><a href="index.php"><i class="icon-22"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        cardDeck.appendChild(newCard);
                    });
                } else {
                    console.error(data.error || 'Failed to fetch ads');
                }
            })
            .catch(error => {
                console.error('Error fetching ads:', error);
            });
    }
 
    // Fetch ads when the page loads
    fetchAds();

     // Sidebar toggle function
     function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('collapsed');
        document.querySelector('.content').classList.toggle('expanded');
    }

    // Add click event to sidebar links
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            // Remove active class from all links
            sidebarLinks.forEach(link => link.classList.remove('active'));

            // Add active class to the clicked link
            this.classList.add('active');

            // Hide all content sections
            contentSections.forEach(section => section.style.display = 'none');

            // Show the selected content section
            const targetSection = document.querySelector(this.getAttribute('href'));
            targetSection.style.display = 'block';
        });
    });

    // Show the default section (Profile section)
    const defaultSection = document.querySelector('.sidebar .nav-link.active');
    if (defaultSection) {
        const targetSection = document.querySelector(defaultSection.getAttribute('href'));
        targetSection.style.display = 'block';
    }



    // Handle image selection and preview
    fileInput.addEventListener('change', function() {
        const files = Array.from(this.files); // Convert FileList to Array
        selectedFiles = [...selectedFiles, ...files]; // Append new files to the existing array
        console.log(selectedFiles);
        // Update hidden input with base64 data for each selected file
        const fileDataArray = [];
        selectedFiles.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                fileDataArray.push(e.target.result);
                // Update the hidden input field
                selectedFilesData.value = JSON.stringify(fileDataArray);
                
                // Display the image previews
                imagePreviewContainer.innerHTML = '';
                fileDataArray.forEach(dataUrl => {
                    const imgElement = document.createElement('img');
                    imgElement.src = dataUrl;
                    imgElement.style.width = '100px';
                    imgElement.style.marginRight = '10px';
                    imgElement.style.marginBottom = '10px';
                    imagePreviewContainer.appendChild(imgElement);
                });
            };
            reader.readAsDataURL(file);
        });
    });

    submitAdForm.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('Files before submission:', selectedFiles); // Debugging statement
        if (selectedFiles.length < 3 || selectedFiles.length > 5) {
            alert('Please upload between 3 and 5 reference images.');
            return;
        }

        const adTitle = document.getElementById('adTitle').value.trim();
        const adDescription = document.getElementById('adDescription').value.trim();
        const adImage = document.getElementById('adImage').files[0];
        const authorImage = document.getElementById('authorImage') ? document.getElementById('authorImage').files[0] : null;
        const adLocation = document.getElementById('adLocation').value.trim();
        const adPrice = document.getElementById('adPrice').value.trim();
        const authorName = document.getElementById('authorName') ? document.getElementById('authorName').value.trim() : '';
        const authorRole = document.getElementById('authorRole') ? document.getElementById('authorRole').value.trim() : '';

        const formData = new FormData();
        formData.append('title', adTitle);
        formData.append('description', adDescription);
        formData.append('adImage', adImage);
        formData.append('authorImage', authorImage);
        formData.append('category', selectedCategory);
        formData.append('location', adLocation);
        formData.append('price', adPrice);
        formData.append('authorName', authorName);
        formData.append('authorRole', authorRole)
        // Append each file to the FormData object
        selectedFiles.forEach(file => {
            formData.append('reference_images[]', file);
        });


fetch('controller/userController.php?action=submitAd', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text()) // Convert response to text
.then(text => {
    try {
        
        console.log(text);
        const data = JSON.parse(text); // Attempt to parse JSON
      
        if (data.success) {
            alert('Ad submitted successfully');
            submitAdForm.reset();
            // imagePreviewContainer.innerHTML = '';
            // selectedFiles = [];
            //selectedFilesData.value = '';
        } else {
            alert(data.error || 'Submission failed');
        }
    } catch (e) {
        console.error('Error parsing JSON:', e);
        alert('An unexpected error occurred. Please try again.');
    }
})
.catch(error => console.error('Error submitting ad:', error));
    });
});
