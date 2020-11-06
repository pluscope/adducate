<?php
SDL_Init(SDL_INIT_EVERYTHING);

$window = SDL_CreateWindow("Fixed pipeline example", SDL_WINDOWPOS_CENTERED, SDL_WINDOWPOS_CENTERED,
    640, 480, SDL_WINDOW_OPENGL | SDL_WINDOW_SHOWN);
SDL_GL_CreateContext($window);

glClearColor(0, 0, .2, 1);
glClear(GL_COLOR_BUFFER_BIT);
SDL_GL_SwapWindow($window);

$event = new SDL_Event;
while(true) {
    SDL_PollEvent($event);
    if($event->type == SDL_KEYDOWN) break;
    SDL_Delay(50);
}

SDL_DestroyWindow($window);

?>
<html>
<body>
<div class="body">
    <div class="container" id="container-menu">
        <?php include($_SERVER["DOCUMENT_ROOT"]."/menu.php"); ?>
    </div>
    <div class="container" id="container-page">
        <!-- content start-->
        <div class="container">
            <div class="container-body container-expand">
                <div class="container-body-white-center">
                </div>
            </div>
        </div>

    </div>
    <!-- content end-->
</div>
</div>
</body>
</html>

