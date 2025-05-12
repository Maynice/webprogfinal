async function setupNavbar() {
    const navLinks = document.getElementById("nav-links");
    const authControls = document.getElementById("auth-controls");

    try {
        const user = await API.me();
        // Build navigation links based on role
        let links = "";
        if (user.role === "admin") {
            links += `<li class="nav-item"><a class="nav-link" href="/admin/users.html">Manage Users</a></li>`;
            links += `<li class="nav-item"><a class="nav-link" href="/admin/applications.html">Manage Applications</a></li>`;
            links += `<li class="nav-item"><a class="nav-link" href="/admin/reports.html">Reports</a></li>`;
        } else if (user.role === "reviewer") {
            links += `<li class="nav-item"><a class="nav-link" href="/reviewer/applications.html">Manage Applications</a></li>`;
        } else {
          links += `<li class="nav-item"><a class="nav-link" href="/applicant/applications.html">My Application</a></li>`;
          links += `<li class="nav-item"><a class="nav-link" href="/applicant/exercisefix.html">Create New Application</a></li>`;
        }
        navLinks.innerHTML = links;

        // Build auth controls
        authControls.innerHTML = `
        <a class="nav-link" href="/dashboard.html"><span class="fw-semibold text-dark">Welcome, ${user.name} (${user.role.charAt(0).toUpperCase() + user.role.slice(1)})</span></a>
        <button class="btn btn-danger btn-sm" id="logout-btn">Logout</button>
      `;

        document
            .getElementById("logout-btn")
            .addEventListener("click", async () => {
                await API.logout();
                localStorage.removeItem("token");
                window.location.href = "login.html";
            });
    } catch {
        navLinks.innerHTML = "";
        authControls.innerHTML = `
        <a class="btn btn-custom-navbar btn-sm" href="login.html">Login</a>
        <a class="btn btn-custom-navbar btn-sm" href="register.html">Register</a>
      `;
    }
}

setupNavbar();
