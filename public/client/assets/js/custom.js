"use strict";

// link to the according page

let navLinks = document.querySelectorAll(".pageLinks");

navLinks?.forEach((link) => {
    link.addEventListener("click", () => {
        const pageUrl = link.href;

        window.location = pageUrl;
    });
});

// send contact data

const contactModal = document.getElementById("contactModal");
const contactForm = document.querySelector(".contact-form");
const body = document.querySelector("body");

async function sendContactData(e) {
    e.preventDefault();
    if (contactModal) {
        const contactName = contactForm.querySelector("input[name='name']").value;
        const contactEmail = contactForm.querySelector("input[name='email']").value;
        const contactMessage = contactForm.querySelector("textarea").value;

        const allFormValues = {
            contactName,
            contactEmail,
            contactMessage,
        };
        const modalMessage = contactModal.querySelector("h3");

        clearErrorMessages();

        try {
            const res = await fetch("https://azcosmetics.coder.az/api/send-contact-form", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(allFormValues)
            });

            const data = await res.json();

            if (data.success) {
                modalMessage.innerText = data.message;
                showModal();
                setTimeout(hideModal, 2000);
            } else {
                console.log(data.errors)
                showValidationErrors(data.errors);
            }
        } catch (error) {
            console.error('Error:', error);
        } finally {
            console.log("Data fetched!");
        }
    }
}

function clearErrorMessages() {
    const errorSpans = document.querySelectorAll(".error-message");
    errorSpans.forEach(span => span.remove());
}

function showValidationErrors(errors) {
    if (errors.contactName) {
        const nameInput = contactForm.querySelector("input[name='name']");
        const nameError = document.createElement("span");
        nameError.className = "error-message text-danger";
        nameError.innerText = errors.contactName;
        nameInput.parentNode.appendChild(nameError);
    }

    if (errors.contactEmail) {
        const emailInput = contactForm.querySelector("input[name='email']");
        const emailError = document.createElement("span");
        emailError.className = "error-message text-danger";
        emailError.innerText = errors.contactEmail;
        emailInput.parentNode.appendChild(emailError);
    }
}

function showModal() {
    contactModal.setAttribute("aria-modal", "true");
    contactModal.removeAttribute("aria-hidden");
    contactModal.setAttribute("role", "dialog");
    contactModal.style.display = "block";
    contactModal.style.backgroundColor = "rgb(0, 0, 0, 0.5)";
    contactModal.classList.add("show");
    body.classList.add("modal-open");
}

function hideModal() {
    contactModal.style.display = "none";
}

contactForm?.addEventListener("submit", sendContactData);

// open categories

const categories = document.querySelectorAll("#categories");

categories.forEach((category) => {
    category.parentElement.addEventListener("click", (e) => {
        e.preventDefault();
        category.classList.toggle("show");
    });
});

// magnifying glass

function magnify(imgID, zoom) {
    var img, glass, w, h, bw;
    img = document.getElementById(imgID);
    /*create magnifier glass:*/
    glass = document.createElement("DIV");
    glass.setAttribute("class", "img-magnifier-glass");
    /*insert magnifier glass:*/
    if (img) {
        img.parentElement.insertBefore(glass, img);
        /*set background properties for the magnifier glass:*/
        const imgSrc = img.getAttribute("data-src");
        glass.style.backgroundImage = "url('" + imgSrc + "')";
        glass.style.backgroundRepeat = "no-repeat";
        glass.style.backgroundSize =
            img.width * zoom + "px " + img.height * zoom + "px";
        bw = 3;
        w = glass.offsetWidth / 2;
        h = glass.offsetHeight / 2;
        /*execute a function when someone moves the magnifier glass over the image:*/
        glass.addEventListener("mousemove", moveMagnifier);
        img.addEventListener("mousemove", moveMagnifier);
        /*and also for touch screens:*/
        glass.addEventListener("touchmove", moveMagnifier);
        img.addEventListener("touchmove", moveMagnifier);
        function moveMagnifier(e) {
            var pos, x, y;
            /*prevent any other actions that may occur when moving over the image*/
            e.preventDefault();
            /*get the cursor's x and y positions:*/
            pos = getCursorPos(e);
            x = pos.x;
            y = pos.y;
            /*prevent the magnifier glass from being positioned outside the image:*/
            if (x > img.width - w / zoom) {
                x = img.width - w / zoom;
            }
            if (x < w / zoom) {
                x = w / zoom;
            }
            if (y > img.height - h / zoom) {
                y = img.height - h / zoom;
            }
            if (y < h / zoom) {
                y = h / zoom;
            }
            /*set the position of the magnifier glass:*/
            glass.style.left = x - w + "px";
            glass.style.top = y - h + "px";
            /*display what the magnifier glass "sees":*/
            glass.style.backgroundPosition =
                "-" + (x * zoom - w + bw) + "px -" + (y * zoom - h + bw) + "px";
        }
        function getCursorPos(e) {
            var a,
                x = 0,
                y = 0;
            e = e || window.event;
            /*get the x and y positions of the image:*/
            a = img.getBoundingClientRect();
            /*calculate the cursor's x and y coordinates, relative to the image:*/
            x = e.pageX - a.left;
            y = e.pageY - a.top;
            /*consider any page scrolling:*/
            x = x - window.scrollX;
            y = y - window.scrollY;
            return { x: x, y: y };
        }
    }
}

magnify("colorPalet", 3);