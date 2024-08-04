<?php
require_once '../Models/func.php';

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
        return signup($data);
    }

    public function login($data) {
        return login($data);
    }

    public function getFeaturedAdById($id) {
        return getFeaturedAdById($id);
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

        case 'getFeaturedAdById':
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                header('Content-Type: application/json');
                echo json_encode($controller->getFeaturedAdById($id));
            } else {
                echo json_encode(['error' => 'No ad ID specified']);
            }
            break;

            case 'fetchProfile':
                $userId = $_SESSION['user_id'];
                $user = getUserById($userId);
                echo json_encode($user);
                break;
        
            case 'updateProfile':
                $userId = $_SESSION['user_id'];
                $name = $_POST['name'] ?? '';
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
        
                if (updateUserProfile($userId, $name, $email, $password)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Update failed']);
                }
                break;

        default:
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['error' => 'No action specified']);
}
?>
