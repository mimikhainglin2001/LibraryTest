<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .auth-message {
            padding: 0.75rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            margin-bottom: 1rem;
            text-align: center;
        }

        .auth-message.error {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .auth-message.success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        body {
            font-family: Inter, sans-serif;
            font-weight: 16px;
            min-height: 100vh;
            background: #DBEAFE;
            display: flex;
        }

        .main-content-area {
            flex-grow: 1;
            padding: 20px;
            margin-left: 256px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
            margin-top: -50px;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            background: #1e3a8a;
            color: white;
            text-align: center;
            padding: 30px 20px;
            position: relative;
        }

        .header h2 {
            font-size: 1.8rem;
            font-weight: 600;
            position: relative;
            z-index: 1;
        }

        .form-container {
            padding: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: #4CAF50;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }

        .file-input-wrapper {
            position: relative;
            width: 100%;
        }

        .file-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-display {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 16px;
            border: 2px dashed #e1e5e9;
            border-radius: 10px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .quantity-wrapper {
            display: flex;
            align-items: center;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            background-color: white;
        }

        .quantity-btn {
            background: #f8f9fa;
            border: none;
            padding: 12px 16px;
            cursor: pointer;
            color: #666;
        }

        .quantity-input {
            border: none;
            padding: 12px 16px;
            text-align: center;
            flex: 1;
            font-size: 1rem;
            background: white;
        }

        .full-width-buttons {
            grid-column: 1 / -1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .submit-btn {
            width: 100%;
            background: #1e3a8a;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .back-btn {
            width: 100%;
            background: white;
            color: #666;
            border: 2px solid #e1e5e9;
            padding: 12px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .message {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .loading {
            position: relative;
            color: transparent !important;
        }

        .loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid transparent;
            border-top: 2px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <?php require_once APPROOT . '/views/inc/sidebar.php'; ?>

    <div class="main-content-area">
        <div class="container">
            <div class="header">
                <div class="icon"><i class="fas fa-book-open"></i></div>
                <h2>Add New Book</h2>
            </div>

            <div class="form-container">
                <form id="addBookForm" method="POST" action="<?php echo URLROOT; ?>/book/registerBook" enctype="multipart/form-data">
                    <?php require APPROOT . '/views/components/auth_message.php'; ?>
                    <div id="messageContainer"></div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="chooseImage">Book Cover Image</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="image" id="chooseImage" class="file-input" accept="image/*">
                                <div class="file-input-display">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Choose book cover image</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Book Title</label>
                            <input type="text" name="title" id="title" class="form-input" placeholder="Enter book title" required>
                        </div>

                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" id="author" class="form-input" placeholder="Enter author name" required>
                        </div>

                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input type="text" name="isbn" id="isbn" class="form-input" placeholder="Enter ISBN number" required>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-input" required>
                                <option value="">Select a category</option>
                                <option value="Literary Book">Literary Book</option>
                                <option value="Historical Book">Historical Book</option>
                                <option value="Education/References Book">Education/References Book</option>
                                <option value="Romance Book">Romance Book</option>
                                <option value="Horror Book">Horror Book</option>
                                <option value="Cartoon Book">Cartoon Book</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantityInput">Quantity</label>
                            <div class="quantity-wrapper">
                                <button type="button" id="decrementQuantity" class="quantity-btn"><i class="fas fa-minus"></i></button>
                                <input type="number" name="total_quantity" id="quantityInput" value="1" min="1" class="quantity-input" readonly>
                                <button type="button" id="incrementQuantity" class="quantity-btn"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="full-width-buttons">
                            <button type="submit" name="submit" class="submit-btn" id="submitBtn">
                                <i class="fas fa-plus-circle"></i> Add Book
                            </button>

                            <button type="button" class="back-btn" onclick="window.location.href='<?php echo URLROOT; ?>/admin/manageBook'">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // quantity controls
        const decrementBtn = document.getElementById('decrementQuantity');
        const incrementBtn = document.getElementById('incrementQuantity');
        const quantityInput = document.getElementById('quantityInput');

        decrementBtn.addEventListener('click', () => {
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });
        incrementBtn.addEventListener('click', () => {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });

        // file input preview
        const fileInput = document.getElementById('chooseImage');
        const fileDisplay = document.querySelector('.file-input-display span');
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                fileDisplay.textContent = e.target.files[0].name;
                fileDisplay.parentElement.style.borderColor = '#4CAF50';
            } else {
                fileDisplay.textContent = 'Choose book cover image';
                fileDisplay.parentElement.style.borderColor = '#e1e5e9';
            }
        });

        // AJAX form submit
        const form = document.getElementById('addBookForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            submitBtn.classList.add('loading');
            submitBtn.disabled = true;

            const formData = new FormData(form);

            try {
                const res = await fetch("<?php echo URLROOT; ?>/book/registerBook", {
                    method: "POST",
                    body: formData
                });
                const data = await res.json();
                handleResponse(data);
            } catch (error) {
                showMessage("Something went wrong. Try again.", "error");
                console.error(error);
            } finally {
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
            }
        });

        function handleResponse(data) {
            clearErrors();

            if (data.success) {
                showMessage("Book added successfully!", "success");
                form.reset();
                document.querySelector(".file-input-display span").textContent = "Choose book cover image";
            } else {
                for (const field in data.errors) {
                    const input = document.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.add("border-red-500");
                        const errorDiv = document.createElement("div");
                        errorDiv.className = "text-red-500 text-sm mt-1";
                        errorDiv.innerText = data.errors[field];
                        input.parentElement.appendChild(errorDiv);
                    }
                }
            }
        }

        function clearErrors() {
            document.querySelectorAll(".text-red-500").forEach(el => el.remove());
            document.querySelectorAll(".form-input").forEach(el => el.classList.remove("border-red-500"));
        }

        function showMessage(text, type) {
            const messageContainer = document.getElementById('messageContainer');
            messageContainer.innerHTML = `<div class="message ${type}">${text}</div>`;
            setTimeout(() => {
                messageContainer.innerHTML = '';
            }, 5000);
        }
    </script>
</body>

</html>