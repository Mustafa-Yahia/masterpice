
    function toggleVolunteerField(show) {
        var volunteerField = document.getElementById('volunteer_details');
        if (show) {
            volunteerField.style.display = 'block'; // إظهار حقل التفاصيل
        } else {
            volunteerField.style.display = 'none'; // إخفاء حقل التفاصيل
        }
    }


// ==================================================================================================

    document.getElementById('nationality').addEventListener('change', function() {
        var nationality = this.value;
        var nationalIdRow = document.getElementById('national_id_row');

        if (nationality === 'الأردنية') {
            nationalIdRow.style.display = 'block';  // إظهار حقل الرقم الوطني
        } else {
            nationalIdRow.style.display = 'none';  // إخفاء حقل الرقم الوطني
            document.getElementById('national_id').value = '';  // مسح حقل الرقم الوطني
            document.getElementById('national_id-error').style.display = 'none';  // إخفاء رسالة الخطأ
        }
    });

    document.getElementById('national_id').addEventListener('input', function() {
        var nationalId = this.value;
        var errorElement = document.getElementById('national_id-error');

        // التحقق من أن الرقم يتكون من 10 أرقام ويبدأ بـ "2"
        if (/^\d{10}$/.test(nationalId) && nationalId.startsWith('2')) {
            errorElement.style.display = 'none';  // إخفاء رسالة الخطأ
        } else {
            errorElement.style.display = 'block';  // عرض رسالة الخطأ
        }
    });

// ==================================================================================================



    // التحقق من العمر عندما يتغير تاريخ الميلاد
    document.getElementById('birth_date').addEventListener('change', function() {
        var birthDate = new Date(this.value);
        var age = calculateAge(birthDate); // حساب العمر
        var errorElement = document.getElementById('age-error');

        // التحقق إذا كان العمر أكبر من أو يساوي 18
        if (age >= 18) {
            errorElement.style.display = 'none'; // إخفاء رسالة الخطأ إذا كان العمر 18 أو أكثر
        } else {
            errorElement.style.display = 'block'; // إظهار رسالة الخطأ إذا كان العمر أقل من 18
        }
    });
    // دالة لحساب العمر
    function calculateAge(birthDate) {
        var today = new Date();
        var age = today.getFullYear() - birthDate.getFullYear();
        var month = today.getMonth() - birthDate.getMonth();

        if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        return age;
    }



// ===============================================================================================

    // تهيئة مكتبة intl-tel-input
    var input = document.querySelector("#phone");
    var iti = window.intlTelInput(input, {
        initialCountry: "auto", // تحديد البلد تلقائيًا بناءً على IP
        geoIpLookup: function(callback) {
            fetch("https://ipinfo.io?token=your_token_here") // يمكنك استخدام خدمة لتحديد البلد من الـ IP
                .then(function(response) { return response.json(); })
                .then(function(data) { callback(data.country); });
        },
        preferredCountries: ["us", "gb", "sa", "ae", "jo"], // ترتيب الدول المفضلة في الأعلى
        separateDialCode: true, // عرض رمز الدولة بشكل منفصل عن الرقم
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js", // لتحسين التحقق من صحة الرقم
    });

    // عندما يتم اختيار الدولة، نقوم بتحديث الـ placeholder
    iti.on("countrychange", function() {
        var countryData = iti.getSelectedCountryData();
        var exampleNumber = countryData.dialCode; // الحصول على رمز البلد
        var placeholderExample = exampleNumber + " 1234567890"; // بناء مثال على الرقم
        input.placeholder = "مثال: " + placeholderExample; // تحديث الـ placeholder
    });

    // التحقق من الرقم عندما يفقد الحقل التركيز (عند الانتقال من input لآخر)
    input.addEventListener("blur", function() {
        var isValid = iti.isValidNumber(); // التحقق من صحة الرقم
        var errorElement = document.getElementById("phone-error");

        // إذا كان الرقم صالحًا
        if (isValid) {
            errorElement.style.display = "none"; // إخفاء رسالة الخطأ إذا كان الرقم صالحًا
        } else {
            errorElement.style.display = "block"; // إظهار رسالة الخطأ إذا كان الرقم غير صالح
        }
    });
    var countryData = iti.getSelectedCountryData();
    var exampleNumber = countryData.dialCode;
    var placeholderExample = exampleNumber + " 1234567890";
    input.placeholder = "مثال: " + placeholderExample;



// =========================================================================================

document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("form").addEventListener("submit", function (event) {
        let checkboxes = document.querySelectorAll('input[name="volunteer_programs[]"]:checked');
        if (checkboxes.length === 0) {
            event.preventDefault(); // منع الإرسال
            Swal.fire({
                icon: 'error',
                title: 'خطأ في الإدخال!',
                text: 'يجب اختيار برنامج تطوعي واحد على الأقل قبل الإرسال.',
                confirmButtonText: 'حسنًا',
            });
        }
    });
});
