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
         const files = this.files;

        // Loop through each selected file and display the preview
        for (const file of files) {
            const reader = new FileReader();

            reader.onload = function (e) {
                // Create a new image element for the preview
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.style.width = '100px'; // Set width as desired
                imgElement.style.marginRight = '10px'; // Add some spacing between images
                imgElement.style.marginBottom = '10px'; // Add some spacing between rows

                // Append the new image to the preview container
                imagePreviewContainer.appendChild(imgElement);
            };

            // Read the file as a Data URL
            reader.readAsDataURL(file);
        }
    });


    // Handle image removal
    // imagePreviewContainer.addEventListener('click', function(e) {
    //     if (e.target.classList.contains('remove-image-btn')) {
    //         const index = e.target.getAttribute('data-index');
    //         let files = Array.from(fileInput.files);
    //         files.splice(index, 1); // Remove the selected image
    //         const dataTransfer = new DataTransfer();
    //         files.forEach(file => dataTransfer.items.add(file));
    //         fileInput.files = dataTransfer.files;

    //         // Re-trigger the change event to update the preview
    //         fileInput.dispatchEvent(new Event('change'));
    //     }
    // });

    submitAdForm.addEventListener('submit', function(e) {
        e.preventDefault();

      const files = fileInput.files;
        if (files.length < 3 || files.length > 5) {
            
            alert('Please upload between 3 and 5 reference images.');
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
        formData.append('authorRole', authorRole);

        // console.log('Submitting form with data:', {
        //     title: adTitle,
        //     description: adDescription,
        //     adImage: adImage ? adImage.name : null,
        //     authorImage: authorImage ? authorImage.name : null,
        //     category: selectedCategory,
        //     location: adLocation,
        //     price: adPrice,
        //     authorName: authorName,
        //     authorRole: authorRole
        // });

        fetch('controller/userController.php?action=submitAd', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Server response:', data);

            if (data.success) {
                // Add new ad to the page
                const cardDeck = document.getElementById('listings-cards');
                const newCard = document.createElement('div');
                newCard.className = 'card border-0 shadow-sm mb-3';
                newCard.innerHTML = `
                    <div style="width: 100%; height: 200px; overflow: hidden;">
                        <img src="${data.adImageUrl}" style="width: 100%; height: 100%; object-fit: cover;" alt="${adTitle}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">${adTitle}</h5>
                        <p class="card-text">${adDescription}</p>
                    </div>
                    <div class="card-footer border-0 bg-transparent">
                        <img src="${data.authorImageUrl}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; margin-right: 10px;" alt="${authorName}">
                        <small class="text-muted">${authorName} - ${authorRole}</small>
                        <small class="text-muted">Posted just now</small>
                    </div>
                `;
                cardDeck.appendChild(newCard);

                // Reset form and modal
                // alert('Ad submitted successfully');
                $('#submitAdModal').modal('hide');
                submitAdForm.reset();
                categoryButton.textContent = 'Select Category'; // Reset category button text
                selectedCategory = '';
            } else {
                alert(data.error || 'Submission failed');
            }
        })
        .catch(error => {
            console.error('Error submitting ad:', error);
            alert('An error occurred while submitting the ad.');
        });
    });
});






