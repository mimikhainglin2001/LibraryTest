<?php require_once APPROOT . '/views/inc/header.php'; ?>
<div style="max-width: 600px; margin: 40px auto; background: #f9fafb; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); font-family: Arial, sans-serif;">

    <h2 style="text-align: center; color: #1f2937; margin-bottom: 24px;">Edit Profile</h2>

    <form method="POST" action="<?php echo URLROOT; ?>/user/editProfile/<?php echo $data['loginuser']['id']; ?>">

        <div>
            <label style="display: block; margin-bottom: 6px; font-weight: bold; color: #374151;">Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($data['loginuser']['name']); ?>"
                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 6px; font-weight: bold; color: #374151;">Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($data['loginuser']['email']); ?>"
                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 6px; font-weight: bold; color: #374151;">Gender</label>
            <select name="gender" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                <option value="Female" <?= $data['loginuser']['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Male" <?= $data['loginuser']['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
            </select>
        </div>

        <div>
            <label style="display: block; margin-bottom: 6px; font-weight: bold; color: #374151;">Roll No</label>
            <input type="text" name="rollno" value="<?php echo htmlspecialchars($data['loginuser']['rollno']); ?>"
                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 6px; font-weight: bold; color: #374151;">Year</label>
            <input type="text" name="year" value="<?php echo htmlspecialchars($data['loginuser']['year']); ?>"
                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
        </div>

         <div style="text-align: center; margin-top: 10px;">
            <button type="cancel" class="<?php echo URLROOT;?>/pages/userProfile/"
                style="background-color: #3b82f6; color: white; padding: 10px 20px; font-weight: bold; border: none; border-radius: 8px; cursor: pointer;">
                Cancel
            </button>
        </div>

        <div style="text-align: center; margin-top: 10px;">
            <button type="submit"
                style="background-color: #3b82f6; color: white; padding: 10px 20px; font-weight: bold; border: none; border-radius: 8px; cursor: pointer;">
                Update
            </button>
        </div>

    </form>
</div>