<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tekken 8 Pretty Movelist</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <!-- // add styling make it small and compact so i can fill an PDF page nicely and is also looking good on print also align content left -->
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        .main-container {
            width: 100%;
            margin: 0 auto;
            padding: 0;
        }
        .section {
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .move-info {
            display: flex;
            align-items: left;
            justify-content: left;
        }
        .move-title {
            margin: 0;
            padding: 0;
        }
        .move-name {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            padding: 0;
        }
        .move-string {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .move-arrow {
            width: 20px;
            height: 20px;
            margin: 0;
            padding: 0;
        }
        .move-button {
            width: 20px;
            height: 20px;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
	<div class="main-container">
    {{foreach from=$sections item=section}}
        <div class="section">
            <h2>{{$section['name']}}</h2>
            <table>
                <thead>
                    <tr>
                        <th width="100px">Name</th>
                        <th>Command</th>
                        <th>Note</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{foreach from=$section['moves'] item=move}}
                        <tr>
                            <td>{{$move['name']}}</td>
                            <td class="move-info">
                                <div class="move-string">
                                    {{foreach from=$move['combo'] item=moveInput}}
                                        {{$moveInput}}
                                    {{/foreach}}
                                </div>
                            </td>
                            <td>{{$move['note'] ?? ''}}</td>
                        </tr>
                    {{/foreach}}
                    </tbody>
                </table>
            </div>
        </div>
    {{/foreach}}
</body>
</html>