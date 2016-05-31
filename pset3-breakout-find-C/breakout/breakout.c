//
// breakout.c
//
// Computer Science 50
// Problem Set 3
//

// standard libraries
#define _XOPEN_SOURCE
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>

// Stanford Portable Library
#include <spl/gevents.h>
#include <spl/gobjects.h>
#include <spl/gwindow.h>

// height and width of game's window in pixels
#define HEIGHT 600
#define WIDTH 400

// number of rows of bricks
#define ROWS 5

// number of columns of bricks
#define COLS 10

// radius and diameter of ball in pixels
#define RADIUS 10
#define DIAM (2 * RADIUS)

// paddle size
#define PAD_WIDTH 50
#define PAD_HEIGHT 10

// brick size
#define BR_WIDTH (WIDTH / COLS) - GAP
#define BR_HEIGHT 15
#define GAP  5

// lives
#define LIVES 3

// speed-up velocity times ___
#define SPEEDUP_RATE 1.02
#define SLOWDOWN_RATE 0.8

// prototypes
void initBricks(GWindow window);
GOval initBall(GWindow window);
GRect initPaddle(GWindow window);
GLabel initScoreboard(GWindow window);
void updateScoreboard(GWindow window, GLabel label, int points);
GObject detectCollision(GWindow window, GOval ball);
char* getColor(char num_char);
void say(GWindow window, char* phrase);

int main(void)
{
    // seed pseudorandom number generator
    srand48(time(NULL));

    // instantiate window
    GWindow window = newGWindow(WIDTH, HEIGHT);

    // instantiate bricks
    initBricks(window);

    // instantiate ball, centered in middle of window
    GOval ball = initBall(window);

    // instantiate paddle, centered at bottom of window
    GRect paddle = initPaddle(window);

    // instantiate scoreboard, centered in middle of window, just above ball
    GLabel label = initScoreboard(window);

    // number of bricks initially
    int bricks = COLS * ROWS;

    // number of lives initially
    int lives = LIVES;

    // number of points initially
    int points = 0;

    // velocity
    double x_velocity = drand48() + 2;
    double y_velocity = 2 * x_velocity;

    // keep playing until game over
    while (lives > 0 && bricks > 0)
    {
        // check for mouse event
        GEvent mouse_event = getNextEvent(MOUSE_EVENT);

        // if there is one
        if (mouse_event != NULL)
        {
            // if the event is move
            if (getEventType(mouse_event) == MOUSE_MOVED)
            {
                // ensure paddle follows mouse
                double x = getX(mouse_event) - getWidth(paddle) / 2;
                setLocation(paddle, x, HEIGHT - PAD_HEIGHT);
            }
        }   
        
        // move ball along x- and y-axix 
        move(ball, x_velocity, y_velocity);

        // bounce off right edge of window
        if (getX(ball) + DIAM >= WIDTH)
            x_velocity = -x_velocity;
                                          
        // bounce off left edge of window
        if (getX(ball) <= 0)
            x_velocity = -x_velocity;

        // bounce off upper edge & speed-up
        if (getY(ball) <= 0)
            y_velocity = -y_velocity * SPEEDUP_RATE;

        // check for collisions with objects
        GObject object = detectCollision(window, ball);
        
        // bounce off objects
        if (object)
        {
            y_velocity = -y_velocity;

            // remove bricks etc
            if (object != paddle)
            {   
                removeGWindow(window, object);
                points++;
                bricks--;
                x_velocity *= SPEEDUP_RATE;
                y_velocity *= SPEEDUP_RATE;
                updateScoreboard(window, label, points);
            }
        }

        // pause after bouncing
        pause(10);

        // if fell
        if (getY(ball) >= HEIGHT - DIAM)
        {
            removeGWindow(window, ball);
            lives--;

            // start over unless dead
            if (lives > 0)
            {
                waitForClick();
                ball = initBall(window);
                x_velocity *= SLOWDOWN_RATE;
                y_velocity = 2 * abs(x_velocity);
            }
        }

        // bounce off smoothly
        pause(10);
    }

    // game over
    if (bricks == 0)
        say(window, "YOU WON! GAME OVER");
    else
        say(window, "YOU LOST! GAME OVER");
    
    // wait for click before exiting
    waitForClick();

    // pause and exit
    pause(1000);
    closeGWindow(window);
    return 0;
}

/**
 * Initializes window with a grid of bricks.
 */
void initBricks(GWindow window)
{
    for (double y = 0; y < (BR_HEIGHT + GAP) * ROWS; y += BR_HEIGHT + GAP)
    {
        for (double x = 0; x < WIDTH; x += BR_WIDTH + GAP)
        {
            
            GRect brick = newGRect(x, y, BR_WIDTH, BR_HEIGHT);
            
            // generate a pseudo-random number to make random
            // color pattern for the bricks
            srand48(x * (y + 1));
            int i = 0;
            char num_char[10];
            sprintf(num_char, "%ld", lrand48());
            
            // exchange a random number for color
            char* color = getColor(num_char[0]);

            setColor(brick, color);
            setFilled(brick, true);
            add(window, brick);
            i++;
        }
    }
}

/**
 * Instantiates ball in center of window.  Returns ball.
 */
GOval initBall(GWindow window)
{
    GOval ball = newGOval(WIDTH / 2 - RADIUS , 
                            HEIGHT / 2 - RADIUS,
                            DIAM, DIAM);
    setFilled(ball, true);
    setColor(ball, "BLACK");
    add(window, ball);
    return ball;
}

/**
 * Instantiates paddle in bottom-middle of window.
 */
GRect initPaddle(GWindow window)
{
    GRect paddle = newGRect((WIDTH - PAD_WIDTH)/2, HEIGHT - PAD_HEIGHT,
                            PAD_WIDTH, PAD_HEIGHT);
    setFilled(paddle, true);
    setColor(paddle, "BLACK");
    add(window, paddle);
    return paddle;
}

/**
 * Instantiates, configures, and returns label for scoreboard.
 */
GLabel initScoreboard(GWindow window)
{
    GLabel label = newGLabel("YOUR SCORE");
    setFont(label, "SansSerif-18");
    setColor(label, "BLACK");
    double x = (getWidth(window) - getWidth(label)) / 2;
    double y = (getHeight(window) - getHeight(label)) / 2;
    setLocation(label, x, y); 
    add(window, label);
    return label;
}

/**
 * Updates scoreboard's label, keeping it centered in window.
 */
// !!!!LATER update so that takes string to say game over 
void updateScoreboard(GWindow window, GLabel label, int points)
{
    // update label
    char s[12];
    sprintf(s, "%i", points);
    setLabel(label, s);

    // center label in window
    double x = (getWidth(window) - getWidth(label)) / 2;
    double y = (getHeight(window) - getHeight(label)) / 2;
    setLocation(label, x, y);
}

/**
 * Detects whether ball has collided with some object in window
 * by checking the four corners of its bounding box (which are
 * outside the ball's GOval, and so the ball can't collide with
 * itself).  Returns object if so, else NULL.
 * Label will be disregarded, and paddle will be reserved only 
 * for bottom.
 */
GObject detectCollision(GWindow window, GOval ball)
{
    // ball's location
    double x = getX(ball);
    double y = getY(ball);

    // for checking for collisions
    GObject object;

    
    // check for collision at ball's top-left corner.
    object = getGObjectAt(window, x, y);
    if (object != NULL && y < HEIGHT - PAD_HEIGHT
            && strcmp(getType(object), "GLabel") != 0)
    {
        return object;
    }

    // check for collision at ball's top-right corner
    object = getGObjectAt(window, x + 2 * RADIUS, y);
    if (object != NULL && y < HEIGHT - PAD_HEIGHT
            && strcmp(getType(object), "GLabel") != 0)
    {
        return object;
    }

    // check for collision at ball's bottom-left corner
    object = getGObjectAt(window, x, y + 2 * RADIUS);
    if (object != NULL && strcmp(getType(object), "GLabel") != 0)
    {
        return object;
    }

    // check for collision at ball's bottom-right corner
    object = getGObjectAt(window, x + 2 * RADIUS, y + 2 * RADIUS);
    if (object != NULL && strcmp(getType(object), "GLabel") != 0)
    {
        return object;
    }

    // no collision
    return NULL;
}

/**
 * Displays a label with a phrase taken as parameter
 * at the end of the game.
 */
void say(GWindow window, char* phrase)
{    
    GLabel label = newGLabel(phrase);
    setFont(label, "SansSerif-18");
    setColor(label, "RED");
    double x = (WIDTH - getWidth(label)) / 2;
    double y = (HEIGHT - getHeight(label)) / 3;
    setLocation(label, x, y);
    add(window, label);
}

/**
 * Function to return different colors depending
 * on the argument given, which is a number
 * converted to char.
 */
char* getColor(char num_char)
{
    switch(num_char)
    {
        case '0':
            return "BLACK";
            break;
        case '1':
            return "YELLOW";
            break;
        case '2':
            return "RED";
            break;
        case '3':
            return "GREEN";
            break;
        case '4':
            return "BLUE";
            break;
        case '5':
            return "MAGENTA";
            break;
        case '6':
            return "CYAN";
            break;
        case '7':
            return "GRAY";
            break;
        case '8':
            return "LIGHT_GRAY";
            break;
        case '9':
            return "ORANGE";
            break;
        default:
            return "BLUE";
            break;
    }
}
