function handleTeam(action) {
    const teamName = document.getElementById('team_name') ? document.getElementById('team_name').value : '';
    const members = document.getElementById('members') ? document.getElementById('members').value : '';
    const searchQuery = document.getElementById('searchKeyword') ? document.getElementById('searchKeyword').value : '';

    let url = 'team.php?action=' + action;
    let method = 'POST';
    let params = new FormData();

    if (action === 'add') {
        params.append('team_name', teamName);
        params.append('members', members);
        url = 'team.php?action=add';
        method = 'POST';
    } else if (action === 'search') {
        url = 'team.php?action=search&search_query=' + encodeURIComponent(searchQuery);
        method = 'GET';
    }

    const xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    
    xhr.onload = function() {
        const response = JSON.parse(xhr.responseText);

        if (action === 'add') {
            alert(response.message);  
            if (response.status === 'success') {
                document.getElementById('team_name').value = '';  
                document.getElementById('members').value = '';  
            }
        }

        if (action === 'search') {
            const teamList = document.getElementById('teamList');
            teamList.innerHTML = '';  

            if (response.length === 0) {
                teamList.innerHTML = '<p>No teams found</p>';
            } else {
                response.forEach(team => {
                    const div = document.createElement('div');
                    div.classList.add('team-item');
                    div.innerHTML = `<strong>${team.team_name}</strong><br>Members: ${team.members}`;
                    teamList.appendChild(div);
                });
            }
        }
    };

    xhr.send(params);
}
