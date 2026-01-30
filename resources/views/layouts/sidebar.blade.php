<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      
    }
    .main-content {
      margin-left: 270px;
      padding: 20px;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <div class="container-fluid">
      <h5 class="text-center mb-4">Labour Act Forms</h5>

      <!-- Continuous Operations -->
      <div class="card mb-3 shadow-sm">
        <div class="card-header bg-primary text-white">
          Continuous Operations
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><a href="{{ route('operations.index') }}" class="text-decoration-none">View Operations</a></li>
          <li class="list-group-item"><a href="{{ route('operations.create') }}" class="text-decoration-none">New Operation</a></li>
        </ul>
      </div>

      <!-- Overtime Applications -->
      <div class="card mb-3 shadow-sm">
        <div class="card-header bg-success text-white">
          Overtime Applications
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><a href="{{ route('overtime-applications.index') }}" class="text-decoration-none">View Applications</a></li>
          <li class="list-group-item"><a href="{{ route('overtime-applications.create') }}" class="text-decoration-none">New Application</a></li>
        </ul>
      </div>

      <!-- Exemption Applications 
      <div class="card mb-3 shadow-sm">
        <div class="card-header bg-info text-white">
          Exemption Applications (Form LM 1)
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><a href="{{ route('exemption-applications.index') }}" class="text-decoration-none">View Applications</a></li>
          <li class="list-group-item"><a href="{{ route('exemption-applications.create') }}" class="text-decoration-none">New Application</a></li>
        </ul>
      </div>-->

      <!-- Exemption Wager 
      <div class="card mb-3 shadow-sm">
        <div class="card-header bg-warning text-white">
          Exemption Wagers (Form LM 1)
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><a href="{{ route('exemption_wagers.index') }}" class="text-decoration-none">View Records</a></li>
          <li class="list-group-item"><a href="{{ route('exemption_wagers.create') }}" class="text-decoration-none">Add New</a></li>
        </ul>
      </div>-->

      <!-- Exemption Variations -->
      <div class="card mb-3 shadow-sm">
        <div class="card-header bg-danger text-white">
          Exemption Variations (Form LM 34)
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><a href="{{ route('exemption_variations.index') }}" class="text-decoration-none">View Records</a></li>
          <li class="list-group-item"><a href="{{ route('exemption_variations.create') }}" class="text-decoration-none">Add New</a></li>
         @role('Administrator')<li class="list-group-item"><a href="{{ route('exemption-variation.declaration') }}" class="text-decoration-none">Make Declaration</a></li>
        </a>
         @endrole
        </ul>
      </div>
 @role('Administrator')
      <!-- Exemption Declarations -->
      <div class="card mb-3 shadow-sm">
        <div class="card-header bg-secondary text-white">
          Exemption Declarations (Form LM 35)
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><a href="{{ route('exemption_declarations.index') }}" class="text-decoration-none">View Declarations</a></li>
          <li class="list-group-item"><a href="{{ route('exemption_declarations.create') }}" class="text-decoration-none">New Declaration</a></li>
        </ul>
      </div>
      @endrole
       @role('Administrator')
      <!-- Exemption Declarations -->
      <div class="card mb-3 shadow-sm">
        <div class="card-header bg-secondary text-white">
          Manage users
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><a href="{{ route('users.index') }}" class="text-decoration-none">View Users</a></li>
               </ul>
      </div>
      @endrole
       @role('Administrator')
      <!-- Exemption Declarations -->
      <div class="card mb-3 shadow-sm">
        <div class="card-header bg-secondary text-white">
          Manage Roles
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><a href="{{ route('roles.index') }}" class="text-decoration-none">View Roless</a></li>
            </ul>
      </div>
      @endrole
    </div>
  </div>

  <div class="main-content">
    @yield('content')
  </div>

</body>
</html>
