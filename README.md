/**
 * Create an Animal Choir simulator (rs_SR: Simulator ?ivotinjskog hora)
 *
 * The task constraints are:
 *
 * There must be 3 different choir member animals
 * (i.e. dogs, cats, mice)
 *
 * Every animal must have a sing method that returns a string representation of a voice
 * (i.e. 'bark', 'meow', 'squeak')
 *
 * Every animal must have a loudness property which can have 3 settings,
 * depending on which the sing method result will be rendered as
 * lowercase, first letter uppercase and uppercase.
 *
 * Singer groups are groups of animals with the same loudness property value.
 * Singer group song is represented with a CSV of the group singer sing result in random order.
 *
 * The choir simulator must have implement the following methods:
 *    crescendo - the choir start singing from the least loud singer group, and then are being joined
 *                by more and more loud singer groups until they are singing all together.
 *                The joining is represented with a new line.
 *                Example:
 *                  meow, squeak, bark
 *                  Meow, bark, squeak, Bark, meow
 *                  bark, Meow, MEOW, squeak, BARK, meow, Bark
 *
 *    arpeggio  - the choir singer groups of the same loudness start singing one by one from
 *                the least loud to the loudest
 *                Example:
 *                  meow, squeak, bark
 *                  Meow, Bark
 *                  MEOW, BARK
 *
 */

TODO: Describe the class hierarchy