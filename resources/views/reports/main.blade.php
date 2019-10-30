<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>{{ ucwords($type) }} Report</title>
</head>
<body>
  <h1>{{ ucwords($type) }} Report</h1>
  <div>
     <h2>Name: {{ $user->name }}</h2>
     <h2>Email: {{ $user->email }}</h2>
  </div>
  <hr />

@foreach($data as $year => $perYear)
  <div>
      <h2>{{ ucwords($type) }} - {{ $year }}</h2>
      <hr />
      @foreach($perYear as $month => $perMonth)
      <h2>{{ $month }}</h2>

      
            @foreach($perMonth as $cat => $total)
                <div>{{ $cat }} Total: {{ $total }}</div>
            @endforeach
        @endforeach
  </div>
@endforeach

<hr />

@foreach($catTotals as $cat => $total)
    <h2>Total {{ $cat }}: {{ $total }}</h2>
    <hr />
@endforeach

TOTAL {{ ucfirst($type) }}: {{ $finalTotal }}
</body>
</body>
</html>