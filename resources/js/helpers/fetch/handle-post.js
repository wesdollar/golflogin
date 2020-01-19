export const handlePost = async ({ url, payload } = {}) => {
  try {
    const response = await fetch(url, {
      method: "POST",
      body: JSON.stringify(payload),
      headers: {
        // eslint-disable-next-line no-undef
        "X-CSRF-TOKEN": GL.csrfToken,
        "Content-Type": "application/json"
      }
    });
    const json = await response.json();

    if (json.ok && json.data.success) {
      console.log("success!");
    }
  } catch (error) {
    console.log(error);
  }
};
