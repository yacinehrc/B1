import random

# Fonctions du programme
def generer_tirage():

    # Génère le tirage de la banque.
    # Utilise random.sample pour garantir 10 chiffres uniques entre 1 et 49.

    return (random.sample(range(1, 50), 10))

def saisir_numeros():
    # Gère la saisie sécurisée de l'utilisateur.
    # Empêche les doublons, les chiffres hors limite et les erreurs de type (lettres).

    user_nums = []
    print("--- SAISIE DE VOS 10 NUMÉROS (1-49) ---")

    while len(user_nums) < 10:
        try:
            choix = int(input(f"Numéro {len(user_nums) + 1} : "))

            # Vérification de l'intervalle [1, 49]
            if choix < 1 or choix > 49:
                print("Erreur : Le numéro doit être entre 1 et 49.")
            # Vérification des doublons dans la liste en cours
            elif choix in user_nums:
                print("Erreur : Vous avez déjà saisi ce numéro.")
            # Si tout est OK, on ajoute à la liste
            else:
                user_nums.append(choix)

        except ValueError:
            # Gestion d'erreur si l'utilisateur saisit autre chose qu'un entier
            print("Erreur : Veuillez entrer un nombre entier valide.")

    return (user_nums)

def calculer_resultats(tirage, saisie):

    # Logique de comparaison :
    # 1. Trouve les numéros communs (intersection).
    # 2. Vérifie le bonus : si le numéro est au même index (place) dans les deux listes.

    # Liste en compréhension pour extraire les numéros gagnants
    gagnants = [n for n in saisie if n in tirage]

    # Comparaison index par index pour le bonus d'ordre
    ordre_correct = sum(1 for i in range(10) if tirage[i] == saisie[i])

    return gagnants, ordre_correct

def afficher_recompense(gagnants, ordre_bonus):

    # Gère l'affichage final et l'attribution des lots.
    # Affiche le détail des numéros trouvés pour améliorer l'expérience utilisateur.

    nb_gagnants = len(gagnants)

    print("\n" + "=" * 30)
    print(f"RÉSULTATS : {nb_gagnants} numéro(s) gagnant(s)")

    # Affichage des numéros spécifiques trouvés
    if nb_gagnants > 0:
        liste_txt = ", ".join(map(str, gagnants))
        print(f"Numéros trouvés : {liste_txt}")
    else:
        print("Aucun numéro trouvé sur ce tirage.")

    # Structure conditionnelle pour les paliers de récompense
    if nb_gagnants == 10:
        gain = "Grand Prix (1 000 000€)"
    elif nb_gagnants >= 5:
        gain = "Prix Intermédiaire (1 000€)"
    elif nb_gagnants >= 1:
        gain = "Petit Prix (Ticket gratuit)"
    else:
        gain = "Aucun gain"

    print(f"Récompense : {gain}")

    # Affichage du bonus si présent
    if ordre_bonus > 0:
        print(f"BONUS : {ordre_bonus} numéro(s) bien placé(s) !")
    print("=" * 30)

# Point D'entrée Du Script
def main():

    # Fonction principale qui orchestre le déroulement du jeu.

    print("--- BIENVENUE SUR LOTO'PSY ---")

    # 1. Génération et Saisie
    tirage_officiel = generer_tirage()
    mes_numeros = saisir_numeros()

    # 2. Traitement des données
    bons_numeros, bonus_ordre = calculer_resultats(tirage_officiel, mes_numeros)

    # 3. Sortie (Affichage)
    print(f"\nTirage officiel : {tirage_officiel}")
    print(f"Vos numéros    : {mes_numeros}")

    afficher_recompense(bons_numeros, bonus_ordre)

if __name__ == "__main__":
    main()