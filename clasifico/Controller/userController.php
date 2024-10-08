<?php
require_once '../Models/func.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Use $user_id for further processing
} else if (isset($_GET['action']) && isset($_GET['action']) != 'signup'){
    // Handle the case where the user is not logged in
    echo "User is not logged in.";
}

class UserController {
    public function getCategories() {
        return getCategories();
    }

    public function getFeaturedAds() {
        return getFeaturedAds();
    }

    public function getNews() {
        return getNews();
    }

    public function getPlaces() {
        return getPlaces();
    }

    public function signup($data) {

        // Ensure 'role' is also provided
        if (isset($data['name']) && isset($data['email']) && isset($data['password']) && isset($data['role'])) {
            $name = htmlspecialchars(trim($data['name']));
            $email = filter_var(trim($data['email']), FILTER_VALIDATE_EMAIL);
            $password = trim($data['password']);
            $role = htmlspecialchars(trim($data['role'])); // Get role from POST data

            if (!$email) {
                return ['success' => false, 'error' => 'Invalid email format'];
            }

            // Call the signup function in func.php
            return signup($name, $email, $password, $role);
        } else {
            return ['success' => false, 'error' => 'Required fields are missing'];
        }
    }

    public function login($data) {
        return login($data);
    }

    public function modifyPassword($data) {
        return modifyPassword($data);
    }

    public function getFeaturedAdById($id) {
        return getFeaturedAdById($id);
    }
    
    public function getAdsByCategory($categoryId) {
        return getAdsByCategory($categoryId);
    }

    public function getAdsByItemTitle($itemTitle) {
        return getAdsByItemTitle($itemTitle);
    }

    public function fetchProfile($userId) {
        return getUserById($userId);
    }

    public function updateProfile($userId, $name, $email, $password) {
        return updateUserProfile($userId, $name, $email, $password);
    }

    public function submitAd($data) {
        return submitAd($data);      
    }

    public function getAdDetails($ad_id) {
        return getAdDetails($ad_id);
    }
    
}

$controller = new UserController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getCategories':
            header('Content-Type: application/json');
            echo json_encode($controller->getCategories());
            break;

        case 'getFeaturedAds':
            header('Content-Type: application/json');
            echo json_encode($controller->getFeaturedAds());
            break;

        case 'getNews':
            header('Content-Type: application/json');
            echo json_encode($controller->getNews());
            break;

        case 'getPlaces':
            header('Content-Type: application/json');
            echo json_encode($controller->getPlaces());
            break;

        case 'signup':
            header('Content-Type: application/json');
            echo json_encode($controller->signup($_POST));
            break;

        case 'login':
            header('Content-Type: application/json');
            echo json_encode($controller->login($_POST));
            break;
        
        case 'resetPassword':
            header('Content-Type: application/json');
            echo json_encode($controller->modifyPassword($_POST));
            break;
        
        case 'changePassword':
            header('Content-Type: application/json');
            echo json_encode($controller->modifyPassword($_POST));
            break;

        case 'getFeaturedAdByUserId':
            if (isset($_GET['user_id'])) {
                $userId = intval($_GET['user_id']);
                header('Content-Type: application/json');
                echo json_encode($controller->getFeaturedAdByUserId($userId));
            } else {
                echo json_encode(['error' => 'No user ID specified']);
            }
            break;
        

        case 'getAdsByCategory':
            if (isset($_GET['category_id'])) {
                $categoryId = $_GET['category_id'];
                header('Content-Type: application/json');
                // echo json_encode($categoryId);
                echo json_encode($controller->getAdsByCategory($categoryId));
            } else {
                echo json_encode(['error' => 'No category ID specified']);
            }
            break;
        
        case 'getAdsByItemTitle':
                if (isset($_GET['itemTitle'])) {
                    $itemTitle = $_GET['itemTitle'];
                    header('Content-Type: application/json');
                    // echo json_encode($categoryId);
                    echo json_encode($controller->getAdsByItemTitle($itemTitle));
                } else {
                    echo json_encode(['error' => 'No category ID specified']);
                }
                break;
            

        case 'fetchProfile':
            $userId = $_SESSION['user_id'];
            $user = $controller->fetchProfile($userId);
            echo json_encode($user);
            break;

        case 'updateProfile':
            $userId = $_SESSION['user_id'];
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($controller->updateProfile($userId, $name, $email, $password)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Update failed']);
            }
            break;

        case 'submitAd':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'submitAd') {
                // Retrieve form data
                $title = trim($_POST['title']);
                $description = trim($_POST['description']);
                $category = trim($_POST['category']);
                $location = trim($_POST['location']);
                $price = trim($_POST['price']);
                $authorName = trim($_POST['authorName'] ?? '');
                $authorRole = trim($_POST['authorRole'] ?? '');
                $iconClass = 'default-icon'; // Provide a default value or handle as needed
                $rating = 0; // Set a default value or handle as needed
                $ratingCount = 0; // Set a default value or handle as needed
                $timeAgo = 'Just now'; // Set a default value or handle as needed
                
        
                // Validate required fields
                if (empty($title) || empty($description) || empty($category) || empty($location) || empty($price)) {
                    echo json_encode(['success' => false, 'error' => 'All fields are required']);
                    exit;
                }
        
                // Handle image uploads
                $targetDir = "../clasifico/assets/uploads/"; // Ensure this directory is writable
                $adImagePath = '';
                $authorImagePath = trim($_POST['authorImage'] ?? '');;
                $referenceImages = []; // Initialize the reference images arr
        
                // Handle ad image upload
                if (isset($_FILES['adImage']) && $_FILES['adImage']['error'] === UPLOAD_ERR_OK) {
                    $adImageName = basename($_FILES['adImage']['name']);
                    $adImagePath = $targetDir . 'ads/' . $adImageName;
        
                    // Validate file type
                    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                    $fileType = pathinfo($adImagePath, PATHINFO_EXTENSION);
                    if (!in_array($fileType, $allowedTypes)) {
                        echo json_encode(['success' => false, 'error' => 'Invalid ad image file type']);
                        exit;
                    }
        
                    // Create directory if it doesn't exist
                    if (!is_dir(dirname($adImagePath))) {
                        mkdir(dirname($adImagePath), 0777, true);
                    }
        
                    // Move the uploaded file to the target directory
                    if (!move_uploaded_file($_FILES['adImage']['tmp_name'], $adImagePath)) {
                        echo json_encode(['success' => false, 'error' => 'Failed to upload ad image']);
                        exit;
                    }
        
                    // Update path to be relative to the root directory for frontend access
                    $adImagePath = str_replace("../", "", $adImagePath);
                } else {
                    echo json_encode(['success' => false, 'error' => 'No ad image uploaded or upload error']);
                    exit;
                }
        
                // Handle author image upload
                // if (isset($_FILES['authorImage']) && $_FILES['authorImage']['error'] === UPLOAD_ERR_OK) {
                //     $authorImageName = basename($_FILES['authorImage']['name']);
                //     $authorImagePath = $targetDir . 'authors/' . $authorImageName;
        
                //     // Validate file type
                //     $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                //     $fileType = pathinfo($authorImagePath, PATHINFO_EXTENSION);
                //     if (!in_array($fileType, $allowedTypes)) {
                //         echo json_encode(['success' => false, 'error' => 'Invalid author image file type']);
                //         exit;
                //     }
        
                //     // Create directory if it doesn't exist
                //     if (!is_dir(dirname($authorImagePath))) {
                //         mkdir(dirname($authorImagePath), 0777, true);
                //     }
        
                //     // Move the uploaded file to the target directory
                //     if (!move_uploaded_file($_FILES['authorImage']['tmp_name'], $authorImagePath)) {
                //         echo json_encode(['success' => false, 'error' => 'Failed to upload author image']);
                //         exit;
                //     }
        
                //     // Update path to be relative to the root directory for frontend access
                //     $authorImagePath = str_replace("../", "", $authorImagePath);
                // }
                
        
              // Handle reference images upload
            if (isset($_FILES['reference_images'])) { // Note: 'reference_images' should match the name attribute in your HTML
                foreach ($_FILES['reference_images']['tmp_name'] as $key => $tmpName) {
                    if ($_FILES['reference_images']['error'][$key] === UPLOAD_ERR_OK) {
                        $referenceImageName = basename($_FILES['reference_images']['name'][$key]);
                        $referenceImagePath = $targetDir . 'reference_images/' . $referenceImageName;
                        $fileType = pathinfo($referenceImagePath, PATHINFO_EXTENSION);
                        if (!in_array($fileType, $allowedTypes)) {
                            echo json_encode(['success' => false, 'error' => 'Invalid reference image file type']);
                            exit;
                        }
                        if (!is_dir(dirname($referenceImagePath))) {
                            mkdir(dirname($referenceImagePath), 0777, true);
                        }
                        if (move_uploaded_file($tmpName, $referenceImagePath)) {
                            $referenceImagePath = str_replace("../", "", $referenceImagePath);
                            $referenceImages[] = $referenceImagePath;
                        } else {
                            echo json_encode(['success' => false, 'error' => 'Failed to upload reference image']);
                            exit;
                        }
                    }
                }
            }

            // Save ad details along with image paths
            if (addFeaturedAd($user_id, $title, $description, $adImagePath, $iconClass, $category, $location, $price, $authorImagePath, $authorName, $authorRole, $rating, $ratingCount, $timeAgo, $referenceImages)) {
                echo json_encode([
                    'success' => true,
                    'adImageUrl' => $adImagePath,
                    'authorImageUrl' => $authorImagePath,
                    'referenceImages' => $referenceImages
                ]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to submit ad']);
            }
        }

        break;

        case 'fetchAdDetails': // New action to fetch ad details
            if (isset($_GET['ad_id'])) {
                $ad_id = intval($_GET['ad_id']);
                header('Content-Type: application/json');
                $adDetails = $controller->getAdDetails($ad_id);
                
                if ($adDetails) {
                    echo json_encode(['status' => 'success', 'data' => $adDetails]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Ad not found']);
                }
            } else {
                echo json_encode(['error' => 'No ad ID specified']);
            }
            break;

        
        case 'getAds':
            header('Content-Type: application/json');
            echo json_encode($controller->getFeaturedAds()); // Assuming this method returns all ads
            break;

    }
} else {
    echo json_encode(['error' => 'No action specified']);
}
?>
