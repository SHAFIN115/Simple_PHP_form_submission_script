


<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <div>
        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount">
        <span id="amount-error"></span>
    </div>

    <label for="buyer">Buyer:</label>
    <input type="text" name="buyer" id="buyer" required>

    <label for="receipt_id">Receipt ID:</label>
    <input type="text" name="receipt_id" id="receipt_id" required>
    <span id="receipt_id-error"></span>

    <!-- <label for="items">Items:</label>
    <input type="text" name="items" id="items" required> -->

    <label for="items">Items:</label>
    <div id="items-container">
        <div class="item-row">
            <input type="text" name="items" class="item-input" required>
            <button type="button" class="remove-item">Remove</button>
        </div>
    </div>
    <button type="button" id="add-item">Add Item</button>
    <span id="items-error"></span>



    <label for="buyer_email">Buyer Email:</label>
    <input type="email" name="buyer_email" id="buyer_email" required>

    

    <!-- <label for="note">Note:</label>
    <textarea name="note" id="note" required></textarea> -->

    <label for="note">Note:</label>
    <textarea name="note" id="note" required></textarea>
    <span id="note-error"></span>


    <label for="city">City:</label>
    <input type="text" name="city" id="city" required>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" required>

    

    <label for="entry_by">Entry By:</label>
    <input type="text" name="entry_by" id="entry_by" required>
    <span id="entry_by-error"></span>

    <button type="submit">Submit</button>
</form>


<script>
    // JavaScript validation for amount field
    const amountInput = document.getElementById('amount');
    const amountError = document.getElementById('amount-error');

    amountInput.addEventListener('input', () => {
        const amount = amountInput.value.trim();
        if (!/^\d+$/.test(amount)) {
            amountError.textContent = 'Amount should contain only numbers.';
        } else {
            amountError.textContent = '';
        }
    });
    //receipt id  validation
    const receiptIdInput = document.getElementById('receipt_id');
    const receiptIdError = document.getElementById('receipt_id-error');

    receiptIdInput.addEventListener('input', () => {
        const receiptId = receiptIdInput.value.trim();
        if (!/^[a-zA-Z]+$/.test(receiptId)) {
            receiptIdError.textContent = 'Receipt ID should contain only text.';
        } else {
            receiptIdError.textContent = '';
        }
});

    //items validation adding more items
    // JavaScript validation for items field
    const itemsContainer = document.getElementById('items-container');
    const addItemBtn = document.getElementById('add-item');
    const itemsError = document.getElementById('items-error');

    function validateItems() {
        const itemInputs = itemsContainer.querySelectorAll('.item-input');
        for (const input of itemInputs) {
            const item = input.value.trim();
            if (item.length === 0) {
                itemsError.textContent = 'Item name is required.';
                return false;
            }
        }
        itemsError.textContent = '';
        return true;
    }

    function addItem() {
        const itemRow = document.createElement('div');
        itemRow.classList.add('item-row');
        const itemInput = document.createElement('input');
        itemInput.type = 'text';
        itemInput.name = 'items';
        itemInput.classList.add('item-input');
        itemInput.required = true;
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.classList.add('remove-item');
        removeBtn.textContent = 'Remove';
        removeBtn.addEventListener('click', () => itemRow.remove());
        itemRow.appendChild(itemInput);
        itemRow.appendChild(removeBtn);
        itemsContainer.appendChild(itemRow);
    }

    addItemBtn.addEventListener('click', addItem);

    itemsContainer.addEventListener('input', () => {
        validateItems();
    });

    // validate items before form submission
    const orderForm = document.querySelector('form');
    orderForm.addEventListener('submit', event => {
        if (!validateItems()) {
            event.preventDefault();
        }
    });

    //Note Validation
    const noteInput = document.getElementById('note');
    const noteError = document.getElementById('note-error');

    noteInput.addEventListener('input', () => {
        const note = noteInput.value.trim();
        const words = note.split(' ').filter(word => word !== '');
        if (words.length > 30) {
            noteError.textContent = 'Note should not exceed 30 words.';
        } else {
            noteError.textContent = '';
        }
    });


    //For City validation
    //letter and spaces
    const cityInput = document.getElementById('city');

    cityInput.addEventListener('input', () => {
        const city = cityInput.value.trim();
        if (!/^[a-zA-Z ]+$/.test(city)) {
            cityInput.setCustomValidity('City should contain only letters and spaces.');
        } else {
            cityInput.setCustomValidity('');
        }
    });

    //Phone number Validation 
    //Phone: only numbers, and 880 will be automatically prepended via js in an appropriate manner.
    // JavaScript validation for phone field
    const phoneInput = document.getElementById('phone');
    const phoneError = document.createElement('span');
    phoneInput.insertAdjacentElement('afterend', phoneError);

    phoneInput.addEventListener('input', () => {
    const phone = phoneInput.value.trim();

    // Remove any non-digit characters from the input
    const digits = phone.replace(/\D/g, '');

    // Add the "880" prefix if the phone number is valid
    if (/^01\d{9}$/.test(digits)) {
        phoneInput.value = '880' + digits;
        phoneError.textContent = '';
    } else {
        phoneError.textContent = 'Phone number should contain only 11 digits and start with "880".';
    }
    });



    //Entry By contains only number
    const entryByInput = document.getElementById('entry_by');
    const entryByError = document.getElementById('entry_by-error');

    entryByInput.addEventListener('input', () => {
        const entryBy = entryByInput.value.trim();
        if (!/^\d+$/.test(entryBy)) {
            entryByError.textContent = 'Entry By should contain only numbers.';
        } else {
            entryByError.textContent = '';
        }
    });

</script>
