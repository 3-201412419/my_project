<!DOCTYPE html>
<html lang="en">
    <head>
        <link
            rel="stylesheet"
            type="text/css"
            href="/my_project/public/assets/css/postscreate.css">
        <!-- Quill Core CSS 파일 -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>글 작성</title>
    </head>
    <body>
        <main class="container">
            <div class="form-container">
                <h2>글 작성하기</h2>
                <form action="/my_project/posts/store" method="post" class="post-form">
                    <div class="form-group">
                        <input
                            type="text"
                            id="title"
                            name="title"
                            required="required"
                            class="form-control"
                            placeholder="제목을 입력하세요...">

                    </div>

                    <div class="form-group">

                        <!-- Quill Editor의 컨테이너 -->
                        <div id="editor-container"></div>
                        <!-- 실제로 서버에 전송될 내용을 담을 숨겨진 필드 -->
                        <input type="hidden" name="content" id="content">
                    </div>

                    <button type="submit" class="btn btn-primary">글 작성</button>
                </form>
            </div>
        </main>

        <!-- Quill Core JS 파일 -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
            var quill = new Quill('#editor-container', {
                theme: 'snow', // 테마 설정
                placeholder: '여기에 내용을 입력하세요...', // 플레이스홀더 텍스트 설정
                modules: {
                    toolbar: [
                        [
                            'bold', 'italic', 'underline', 'strike'
                        ], // toggled buttons
                        [
                            'blockquote', 'code-block'
                        ],

                        [
                            {
                                'header': 1
                            }, {
                                'header': 2
                            }
                        ], // custom button values
                        [
                            {
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }
                        ],
                        [
                            {
                                'script': 'sub'
                            }, {
                                'script': 'super'
                            }
                        ], // superscript/subscript
                        [
                            {
                                'indent': '-1'
                            }, {
                                'indent': '+1'
                            }
                        ], // outdent/indent
                        [
                            {
                                'direction': 'rtl'
                            }
                        ], // text direction

                        [
                            {
                                'size': ['small', false, 'large', 'huge']
                            }
                        ], // custom dropdown
                        [
                            {
                                'header': [
                                    1,
                                    2,
                                    3,
                                    4,
                                    5,
                                    6,
                                    false
                                ]
                            }
                        ],

                        [
                            {
                                'color': []
                            }, {
                                'background': []
                            }
                        ], // dropdown with defaults from theme
                        [
                            {
                                'font': []
                            }
                        ],
                        [
                            {
                                'align': []
                            }
                        ],

                        ['clean'], // remove formatting button

                        ['link', 'image', 'video'] // link and image, video
                    ]
                }
            });

            // 폼 제출 시 에디터의 내용을 숨겨진 필드에 설정
            var form = document.querySelector('form');
            form.onsubmit = function () {
                // 에디터의 내용을 숨겨진 필드에 설정
                var content = document.querySelector('input[name=content]');
                content.value = quill.root.innerHTML;
            };
        </script>
    </body>
</html>