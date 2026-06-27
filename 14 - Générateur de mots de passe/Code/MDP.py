import customtkinter as ctk
import secrets
import string


def generate_password():
    length = int(slider.get())
    # Mélange de caractères pour la sécurité
    chars = string.ascii_letters + string.digits + string.punctuation
    password = "".join(secrets.choice(chars) for _ in range(length))

    entry_password.delete(0, ctk.END)
    entry_password.insert(0, password)


# Configuration de la fenêtre
app = ctk.CTk()
app.geometry("400x300")
app.title("Générateur de mot de passse - Yasss")
ctk.set_appearance_mode("dark")

# UI Elements
label_title = ctk.CTkLabel(app, text="Sécurité Maximale", font=("Roboto", 20, "bold"))
label_title.pack(pady=20)

entry_password = ctk.CTkEntry(app, width=300, justify="center")
entry_password.pack(pady=10)

slider = ctk.CTkSlider(app, from_=8, to=32, number_of_steps=24)
slider.pack(pady=10)

label_len = ctk.CTkLabel(app, text="Longueur : 12")
label_len.pack()

# Update label en temps réel
slider.configure(command=lambda val: label_len.configure(text=f"Longueur : {int(val)}"))

btn_gen = ctk.CTkButton(app, text="Générer", command=generate_password, fg_color="#1f538d")
btn_gen.pack(pady=20)

app.mainloop()