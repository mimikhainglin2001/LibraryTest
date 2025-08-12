<?php
require_once APPROOT . '/middleware/authmiddleware.php';

require_once APPROOT . '/models/BorrowBookModel.php';

class ConfirmReservation extends Controller
{
    private $db;
    public function __construct()
    {
        AuthMiddleware::adminOnly();
        $this->db = new Database();
        $this->model('ConfirmReservationModel');
    }
    public function confirmreservation()
    {
        try {
            $user_id = $_GET['user_id'] ?? null;
            $book_id = $_GET['book_id'] ?? null;
            $available_quantity = isset($_GET['available_quantity']) ? (int)$_GET['available_quantity'] : null;


            if (!$user_id || !$book_id || $available_quantity === null) {
                throw new Exception("Missing required parameters.");
            }

            if ($available_quantity <= 0) {
                throw new Exception("The book is not available for borrow.");
            }

            $reservationRecords = $this->db->columnFilter('reservations', 'book_id', $book_id);
            if (empty($reservationRecords)) {
                throw new Exception("No reservation found for this book.");
            }


            $reservation = $reservationRecords;


            $new_quantity = $available_quantity - 1;

            $update_new_quantity = $this->db->update('reservations', $reservation['id'], ['available_quantity' => $new_quantity]);

            $borrow = new BorrowBookModel();
            $borrow->book_id = $book_id;
            $borrow->user_id = $user_id;
            $borrow->borrow_date = date('Y-m-d H:i:s');
            $borrow->due_date = date('Y-m-d H:i:s', strtotime('+7 days'));
            $borrow->return_date = null;
            $borrow->renew_date = null;
            $borrow->status = 'borrowed';

            $iscreated = $this->db->create('borrowBook', $borrow->toArray());

            $isdelete = $this->db->delete('reservations', $reservation['id']);

            $reserver_again_check = $this->db->columnFilter('reservations', 'book_id', $book_id);
            if (empty($reserver_again_check)) {
                $book_update = $this->db->update('books', $book_id, ['available_quantity' => $new_quantity]);
            }

            // Load reservation list and render the view instead of redirect
            $reservedBookList = $this->db->readAll('reservation_view');
            $data = ['reservedBookList' => $reservedBookList];
            $this->view('admin/reservation', $data);
            exit;
        } catch (Exception $e) {
            // On error: set message and load reservation view with data
            setMessage('error', $e->getMessage());
            $reservedBookList = $this->db->readAll('reservation_view');
            $data = ['reservedBookList' => $reservedBookList];
            $this->view('admin/reservation', $data);
            exit;
        }
    }
}
