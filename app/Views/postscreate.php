<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="/my_project/public/assets/css/postscreate.css">
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
                        <input type="text" id="title" name="title" required="required" class="form-control" placeholder="제목을 입력하세요...">
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
                function selectLocalImage() {
                        const input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.click();

                        input.onchange = () => {
                        const file = input.files[0];

                        // 선택된 파일을 FormData 객체에 추가
                        const formData = new FormData();
                        formData.append('image', file);

                        // FormData 객체를 이용해 파일을 서버로 전송
                        fetch('/my_project/posts/upload_image', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.success) {
                                // 업로드 성공 시, 서버로부터 반환받은 이미지 URL을 에디터에 삽입
                                const range = quill.getSelection();
                                quill.insertEmbed(range.index, 'image', result.url);
                            } else {
                                console.error('Upload failed');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    };
                }

            var quill = new Quill('#editor-container', {
                theme: 'snow',
                placeholder: '여기에 내용을 입력하세요...',
                modules: {
                    toolbar: {
                        container: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{ 'header': 1 }, { 'header': 2 }],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'script': 'sub'}, { 'script': 'super' }],
                            [{ 'indent': '-1'}, { 'indent': '+1' }],
                            [{ 'direction': 'rtl' }],
                            [{ 'size': ['small', false, 'large', 'huge'] }],
                            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'font': [] }],
                            [{ 'align': [] }],
                            ['clean'],
                            ['link', 'image', 'video']
                        ],
                        handlers: {
                            'image': selectLocalImage
                        }
                    }
                }
            });

            var form = document.querySelector('form');
            form.onsubmit = function() {
                var content = document.querySelector('input[name=content]');
                content.value = quill.root.innerHTML;
            };
        </script>
    </body>
</html>