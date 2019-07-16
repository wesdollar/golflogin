export const getNineInputAttributes = startingHoleNumber => {
  // eslint-disable-next-line no-magic-numbers
  const endingHole = startingHoleNumber + 8;
  const data = {};
  let currentHole = startingHoleNumber;
  let label;

  while (currentHole <= endingHole) {
    label = `hole${currentHole}`;
    data[`${label}-par`] = "";
    data[`${label}-yardage`] = "";

    currentHole++;
  }

  return data;
};
