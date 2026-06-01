   // Get the target date/time from the Laravel backend variable
    
  
    //alert(timetest);
    
    const countDownDate = new Date("{{ $endTime }}").getTime();
  
    const timeleft = localStorage.getItem('examtime');
    // Update the count down every 1 second
    const x = setInterval(function() {
        
        // Get today's date and time
        const now = new Date().getTime();

        // Find the distance between now and the count down date
        const distance = timeleft - now;
        
        // Time calculations for days, hours, minutes and seconds
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance  %(1000 * 60)) / 1000);

        // Display the result in the element with id="countdown-timer"
        document.getElementById("countdown-timer").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown-timer").innerHTML = "EXPIRED";
            alert(distance);
            // You can also add code to reload the page or perform other actions here
        }
        localStorage.setItem('examtime', countDownDate);
    }, 1000);
