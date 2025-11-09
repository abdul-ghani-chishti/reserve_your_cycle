<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    @include('user.layout.header')
</head>
<body class="vertical-layout vertical-overlay-menu 2-columns   menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-overlay-menu" data-col="2-columns">
<!-- fixed-top-->
@include('user.layout.navbar')

@include('user.layout.sidebar')
<div class="app-content content" id="app_content">
    <div class="content-wrapper">
    	@if (isset($ticker))
	    	<div class="marquee3k" data-speed="0.25" data-pausable="bool">
				<span>{{ $ticker }}</span>
			</div>
		@endif

        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
{{--@include('user.components.modals')--}}
@include('user.layout.footer')
@include('user.layout.sonic_search')
<audio id="audio_success" autostart="false">
    <source src="{{asset('file/success_sound.mp3')}}" type="audio/ogg">
    <source src="{{asset('file/success_sound.mp3')}}" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
<audio id="audio_error" autostart="false">
    <source src="{{asset('file/error.mp3')}}" type="audio/ogg">
    <source src="{{asset('file/error.mp3')}}" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>


<script type="module">
    // Firebase config
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";
    import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-messaging.js";

    import { getFirestore, collection, addDoc, query, orderBy, onSnapshot, serverTimestamp } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-firestore.js";

    const firebaseConfig = {
        apiKey: "AIzaSyBL8YQagNC6Olp-OJqVrswOqnK1Ku83mFU",
        authDomain: "reserve-cycle.firebaseapp.com",
        projectId: "reserve-cycle",
        storageBucket: "reserve-cycle.firebasestorage.app",
        messagingSenderId: "48529419941",
        appId: "1:48529419941:web:dedffae850f4a8087de74c",
        measurementId: "G-QKMM3G87QR"
    };

    const app = initializeApp(firebaseConfig);
    const messaging = getMessaging(app);
    const db = getFirestore(app);

    // Request permission & get token
    Notification.requestPermission().then(permission => {
        if (permission === "granted") {
            getToken(messaging, { vapidKey: "BOEFNNpBWVKNpjPHcC-kbXP_DuD2hBuyQvD-LbDgLn3NQ6PvDVRrzzG5_QTl-lZh4qSwLxzK7rp2utzEhGH-WHc" }).then(token => {
                console.log("FCM Token:", token);

                // Save token to backend
                fetch('/save-fcm-token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ token })
                });
            }).catch(err => console.error("Error getting token:", err));
        }
    });
    // Listen for foreground messages
    onMessage(messaging, payload => {
        console.log("Message received:", payload);
        alert(payload.notification.title + "\n" + payload.notification.body);
    });
    // firebase config ends


    //firestore for live chat
    const USER_ID = "{{ auth()->id() }}"; // for user side
    const ADMIN_ID = "admin_1"; // you can adjust this for your admin user
    console.log(USER_ID);
    // Send a message
    async function sendMessage() {
        const messageText = document.getElementById("messageInput").value.trim();
        if (!messageText) return;

        const chatRef = collection(db, "chats", `user_${USER_ID}`, "messages");
        await addDoc(chatRef, {
            sender_id: USER_ID,
            receiver_id: ADMIN_ID,
            text: messageText,
            timestamp: serverTimestamp(),
        });

        document.getElementById("messageInput").value = "";
    }

    document.getElementById("sendBtn").addEventListener("click", sendMessage);

    // Listen for new messages in real-time
    function listenForMessages() {
        const chatRef = collection(db, "chats", `user_${USER_ID}`, "messages");
        const q = query(chatRef, orderBy("timestamp"));
        onSnapshot(q, snapshot => {
            const messagesDiv = document.getElementById("messages");
            messagesDiv.innerHTML = "";
            snapshot.forEach(doc => {
                const msg = doc.data();
                const messageElem = document.createElement("div");
                messageElem.textContent = (msg.sender_id == USER_ID ? "You: " : "Admin: ") + msg.text;
                messagesDiv.appendChild(messageElem);
            });
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });
    }

    listenForMessages();
//firestore for live chat ends

// live chat btn
    document.addEventListener("DOMContentLoaded", function() {
        const chatButton = document.getElementById("chatButton");
        const chatPopup = document.getElementById("chatPopup");
        const closeChat = document.getElementById("closeChat");

        chatButton.addEventListener("click", () => {
            chatPopup.classList.toggle("hidden");
        });

        closeChat.addEventListener("click", () => {
            chatPopup.classList.add("hidden");
        });
    });
// live chat btn end
</script>

</body>
</html>
