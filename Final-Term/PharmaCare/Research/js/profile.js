// Function to search for researcher profiles
function searchProfile() {
    const searchQuery = document.getElementById('searchQuery').value;
    const profileList = document.getElementById('profileList');

    // Make an AJAX request to fetch search results
    fetch('../php/search.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `searchQuery=${searchQuery}`
    })
    .then(response => response.json())
    .then(data => {
        // Update the search results list
        profileList.innerHTML = '';
        data.forEach(profile => {
            const listItem = document.createElement('li');
            listItem.textContent = `Researcher Name: ${profile.researcher_name} | Research Name: ${profile.research_name} | Researcher ID: ${profile.researcher_id}`;
            profileList.appendChild(listItem);
        });
    })
    .catch(error => console.error('Error:', error));
}