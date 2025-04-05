document.addEventListener('DOMContentLoaded', function() {
    const chatForm = document.getElementById('chat-form');
    const userInput = document.getElementById('user-input');
    const chatMessages = document.getElementById('chat-messages');
    const festivalCalendar = document.getElementById('festival-calendar');

    // Load initial festival data
    loadFestivals();

    // Handle form submission
    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const message = userInput.value.trim();
        if (!message) return;

        // Add user message to chat
        addMessage(message, 'user');
        userInput.value = '';

        try {
            console.log('Sending message:', message); // Debug log
            
            // Send message to backend
            const response = await fetch('chatbot.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ message: message })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            console.log('Received response:', data); // Debug log
            
            // Add bot response to chat
            if (data.error) {
                addMessage('Sorry, I encountered an error. Please try again.', 'bot');
            } else {
                addMessage(data.response, 'bot');
            }
        } catch (error) {
            console.error('Error:', error);
            addMessage('Sorry, I encountered an error. Please try again.', 'bot');
        }
    });

    // Function to add messages to chat
    function addMessage(content, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}-message`;
        
        const messageContent = document.createElement('div');
        messageContent.className = 'message-content';
        messageContent.textContent = content;
        
        messageDiv.appendChild(messageContent);
        chatMessages.appendChild(messageDiv);
        
        // Scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Function to load festival data
    async function loadFestivals() {
        try {
            console.log('Loading festivals...'); // Debug log
            const response = await fetch('events.php');
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const festivals = await response.json();
            console.log('Received festivals:', festivals); // Debug log
            
            // Display festivals in calendar
            displayFestivals(festivals);
        } catch (error) {
            console.error('Error loading festivals:', error);
        }
    }

    // Function to display festivals
    function displayFestivals(festivals) {
        festivalCalendar.innerHTML = '';
        
        if (!festivals || festivals.length === 0) {
            festivalCalendar.innerHTML = '<p>No upcoming festivals at the moment.</p>';
            return;
        }
        
        festivals.forEach(festival => {
            const festivalCard = document.createElement('div');
            festivalCard.className = 'festival-card';
            festivalCard.innerHTML = `
                <h3>${festival.name}</h3>
                <p>${festival.country}</p>
                <p>Date: ${festival.date}</p>
                <p>${festival.description}</p>
            `;
            festivalCalendar.appendChild(festivalCard);
        });
    }

    // Handle enter key in input
    userInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.dispatchEvent(new Event('submit'));
        }
    });
}); 