<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review DOCX</title>
</head>
<body>
    <h1>Review DOCX Content</h1>
    @foreach ($sections as $section)
        {!! $section->getHtml() !!}
    @endforeach
</body>
</html>