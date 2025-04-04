document.addEventListener("DOMContentLoaded", function () {
    const timers = document.querySelectorAll(".countdown-timer");

    function convertToArabicNumerals(number) {
        const arabicNumerals = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        return number.toString().split('').map(digit => arabicNumerals[parseInt(digit)]).join('');
    }

    timers.forEach(timer => {
        const endTimeAttr = timer.getAttribute("data-end-time");
        if (!endTimeAttr) return;

        const endTime = new Date(endTimeAttr).getTime();
        if (isNaN(endTime)) return;

        function updateCountdown() {
            let now = new Date().getTime();
            let timeDiff = endTime - now;

            const causeBlock = timer.closest(".cause-block-two");
            if (!causeBlock) return;

            const goalAchievedText = causeBlock.querySelector(".goal-achieved-center");
            const goalTimeUpText = causeBlock.querySelector(".goal-time-up-center");
            const progressBar = causeBlock.querySelector(".progress-bar");
            const readMoreBtn = causeBlock.querySelector(".read-more-btn");

            let progressWidth = progressBar ? parseInt(progressBar.style.width) || 0 : 0;

            // ✅ إذا كانت نسبة التقدم 100% أثناء العد التنازلي، يتم:
            if (progressWidth === 100) {
                if (goalAchievedText) goalAchievedText.style.display = 'block';
                if (goalTimeUpText) goalTimeUpText.style.display = 'none';

                // ✅ تعطيل زر "اقرأ المزيد" بدون إخفائه
                if (readMoreBtn) {
                    readMoreBtn.disabled = true;
                    readMoreBtn.style.backgroundColor = "#ccc"; // لون مميز
                    readMoreBtn.style.pointerEvents = "none"; // تعطيل التفاعل
                }
            } else {
                if (goalTimeUpText) goalTimeUpText.style.display = 'none';
                if (goalAchievedText) goalAchievedText.style.display = 'none';

                // ✅ إعادة تفعيل الزر إذا لم تصل النسبة إلى 100%
                if (readMoreBtn) {
                    readMoreBtn.disabled = false;
                    readMoreBtn.style.backgroundColor = ""; // إعادة اللون الأصلي
                    readMoreBtn.style.pointerEvents = "auto"; // تمكين التفاعل
                }
            }

            if (timeDiff <= 0) {
                timer.innerHTML = "<span style='color: green;'>انتهى وقت التبرع</span>";

                causeBlock.classList.add("goal-achieved");

                // ✅ عند انتهاء الوقت، يتم عرض الرسالة الصحيحة بناءً على نسبة التقدم
                if (progressWidth === 100) {
                    if (goalAchievedText) goalAchievedText.style.display = 'block';
                    if (goalTimeUpText) goalTimeUpText.style.display = 'none';
                } else {
                    if (goalTimeUpText) goalTimeUpText.style.display = 'block';
                    if (goalAchievedText) goalAchievedText.style.display = 'none';
                }

                // ✅ تعطيل زر "اقرأ المزيد" عند انتهاء الوقت
                if (readMoreBtn) {
                    readMoreBtn.disabled = true;
                    readMoreBtn.style.backgroundColor = "#ccc";
                    readMoreBtn.style.pointerEvents = "none";
                }

                return;
            }

            let days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            let hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

            timer.querySelector(".time-remaining").innerHTML =
                `${convertToArabicNumerals(days)} يوم ${convertToArabicNumerals(hours)} ساعة ${convertToArabicNumerals(minutes)} دقيقة ${convertToArabicNumerals(seconds)} ثانية`;

            setTimeout(updateCountdown, 1000);
        }

        updateCountdown();
    });
});
