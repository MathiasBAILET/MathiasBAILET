#include <stdio.h> // entré / sortie printf, scanf...
#include <string.h> //fonction pour manipuler les chaines de cara strlen, strcopy
#include <stdlib.h> //gestion de memoire
#include <ctype.h> //fonctions pour tester et convertir des cara
#include <time.h> //fonction pour travailler le temps time...

#define MAX_LONGUEUR_MOT 30
#define FICHIER_DICTIONNAIRE "C:/Users/Huawei/Desktop/pendu/words.txt"
#define MAX_VIES 8

// Fonction pour choisir un mot aléatoire depuis le dictionnaire
char *choisirMotAleatoire()
{
    FILE *fichier = fopen(FICHIER_DICTIONNAIRE, "r");

    if (fichier == NULL)
    {
        perror("Erreur lors de l'ouverture du fichier");
        exit(EXIT_FAILURE);
    }

    // Compter le nombre de mots dans le fichier
    int nombreDeMots = 0;
    char mot[MAX_LONGUEUR_MOT];

    while (fgets(mot, MAX_LONGUEUR_MOT, fichier) != NULL)
    {
        nombreDeMots++;
    }

    // Réinitialiser le pointeur du fichier à la position initiale
    rewind(fichier);

    // Choisir un mot aléatoire
    srand(time(NULL));
    int motAleatoire = rand() % nombreDeMots;

    // Parcourir le fichier jusqu'au mot sélectionné
    int i = 0;
    while (i < motAleatoire && fgets(mot, MAX_LONGUEUR_MOT, fichier) != NULL)
    {
        i++;
    }

    // Fermer le fichier
    fclose(fichier);

    // Supprimer le caractère de retour à la ligne du mot
    size_t longueurMot = strlen(mot);
    if (longueurMot > 0 && mot[longueurMot - 1] == '\n')
    {
        mot[longueurMot - 1] = '\0';
    }

    // Allouer dynamiquement de la mémoire pour le mot sélectionné
    char *motChoisi = (char *)malloc(strlen(mot) + 1);
    if (motChoisi == NULL)
    {
        perror("Erreur lors de l'allocation de memoire");
        exit(EXIT_FAILURE);
    }

    // Copier le mot dans la mémoire allouée
    strcpy(motChoisi, mot);

    return motChoisi;
}

// Fonction pour afficher la figure du pendu en fonction des vies restantes
void afficherPendu(int vies)
{
    printf("Vies restantes : %d\n", vies);

    // Structure switch pour différentes étapes de la figure du pendu
    switch (vies)
    {
    case 8:
        printf("Attention, le pendu va commencer !");
        break;
    case 7:
        printf("  __\n");
        printf(" |   |______\n");
        printf(" |          |\n");
        printf(" |__________|\n");
        break;
    case 6:
        printf("    ____\n");
        printf("   |    |\n");
        printf("   |\n");
        printf("   |\n");
        printf("   |\n");
        printf("   |\n");
        printf("   |\n");
        printf("  _|__\n");
        printf(" |   |______\n");
        printf(" |          |\n");
        printf(" |__________|\n");
        break;
    case 5:
        printf("    ____\n");
        printf("   |    |\n");
        printf("   |    O\n");
        printf("   |\n");
        printf("   |\n");
        printf("   |\n");
        printf("   |\n");
        printf("  _|__\n");
        printf(" |   |______\n");
        printf(" |          |\n");
        printf(" |__________|\n");
        break;
    case 4:
        printf("    ____\n");
        printf("   |    |\n");
        printf("   |    O\n");
        printf("   |    |\\\n");
        printf("   |\n");
        printf("   |\n");
        printf("   |\n");
        printf("  _|__\n");
        printf(" |   |______\n");
        printf(" |          |\n");
        printf(" |__________|\n");
        break;
    case 3:
        printf("    ____\n");
        printf("   |    |\n");
        printf("   |    O\n");
        printf("   |   /|\\\n");
        printf("   |\n");
        printf("   |\n");
        printf("   |\n");
        printf("  _|__\n");
        printf(" |   |______\n");
        printf(" |          |\n");
        printf(" |__________|\n");
        break;
    case 2:
        printf("    ____\n");
        printf("   |    |\n");
        printf("   |    O\n");
        printf("   |   /|\\\n");
        printf("   |    |\n");
        printf("   |\n");
        printf("   |\n");
        printf("   |\n");
        printf("  _|__\n");
        printf(" |   |______\n");
        printf(" |          |\n");
        printf(" |__________|\n");
        break;
    case 1:
        printf("    ____\n");
        printf("   |    |\n");
        printf("   |    O\n");
        printf("   |   /|\\\n");
        printf("   |    |\n");
        printf("   |   / \\\n");
        printf("   |\n");
        printf("   |\n");
        printf("  _|__\n");
        printf(" |   |______\n");
        printf(" |          |\n");
        printf(" |__________|\n");
        break;
    case 0:
        printf("               ...\n");
        printf("             ;::::;\n");
        printf("           ;::::; :;\n");
        printf("         ;:::::'   :;\n");
        printf("        ;:::::;     ;.\n");
        printf("       ,:::::'       ;           OOO\\\n");
        printf("       ::::::;       ;          OOOOO\\\n");
        printf("       ;:::::;       ;         OOOOOOOO\n");
        printf("      ,;::::::;     ;'         / OOOOOOO\n");
        printf("    ;:::::::::`. ,,,;.        /  / DOOOOOO\n");
        printf("  .';:::::::::::::::::;,     /  /     DOOOO\n");
        printf(" ,::::::;::::::;;;;::::;,   /  /        DOOO\n");
        printf(";`::::::`'::::::;;;::::: ,#/  /          DOOO\n");
        printf(":`:::::::`;::::::;;::: ;::#  /            DOOO\n");
        printf("::`:::::::`;:::::::: ;::::# /              DOO\n");
        printf("`:`:::::::`;:::::: ;::::::#/               DOO\n");
        printf(" :::`:::::::`;; ;:::::::::##                OO\n");
        printf(" ::::`:::::::`;::::::::;:::#                OO\n");
        printf(" `:::::`::::::::::::;'`:;::#                O\n");
        printf("  `:::::`::::::::;' /  / `:#\n");
        printf("   ::::::`:::::;'  /  /   `#\n");
    default:
        printf("Pendu complet ! Tu es mort !");
    }
}

// Fonction pour mettre à jour le tableau des scores
void tableau(char pseudo[], int pointsJoueur, char mot[])
{
    FILE *f = fopen("C:\\Users\\Huawei\\Desktop\\pd\\tableau_des_scores.txt", "a");

    if (f == NULL)
    {
        printf("Erreur lors de l'ouverture du fichier tableau_des_scores");
        exit(1);
    }
    fprintf(f, "Le joueur : %s a obtenu un score de %d. Le mot à deviner etait : %s\n", pseudo, pointsJoueur, mot);

    fclose(f);
}

// Fonction pour jouer au jeu du pendu
void jouerPendu(char *mot, char *pseudo)
{
    char motPartiel[MAX_LONGUEUR_MOT];
    size_t longueurMot = strlen(mot);
    int pointsJoueur = 10;
    int vies = MAX_VIES;


    // Initialiser le mot partiel avec des underscores
    for (size_t i = 0; i < longueurMot; i++)
    {
        motPartiel[i] = '-';
    }
    motPartiel[longueurMot] = '\0';

    char lettretdejarouvee[26] = {0};

    // Boucle principale du jeu
    while (vies > 0 && strcmp(mot, motPartiel) != 0)
    {
        printf("\nLe mot actuel est : %s ", motPartiel);

        char lettre;
        printf("\nVeuillez saisir une lettre de l'alphabet en minuscule : ", pseudo);
        scanf(" %c", &lettre);

        if (lettretdejarouvee[lettre - 'a'] == 1)
        {
            printf("la lettre a deja etait utiliser ou vous avez deja essayer, veuiller en choisir une autre");
            continue;
        }
        lettretdejarouvee[lettre - 'a'] = 1;

        int lettreTrouvee = 0;

        // Vérifier si la lettre devinée est dans le mot
        for (size_t i = 0; i < longueurMot; i++)
        {
            if (tolower(lettre) == tolower(mot[i]))
            {
                motPartiel[i] = mot[i];
                lettreTrouvee = 1;
            }
        }

        // Mettre à jour les points et afficher la figure du pendu
        if (!lettreTrouvee)
        {
            vies--;
            pointsJoueur--;
            afficherPendu(vies);
            printf("La lettre %c n'est pas dans le mot. Il vous reste %d vie(s).\n", lettre, vies);
        }
        else
        {
            pointsJoueur++;
            afficherPendu(vies);
            printf("\nBravo, vous avez trouve la lettre %c dans le mot. Il vous reste %d vie(s).\n", lettre, vies);
        }
    }

    // Afficher le résultat du jeu et mettre à jour le tableau des scores
    if (vies > 0)
    {
        pointsJoueur++;
        printf("Bravo, vous avez trouve le mot : %s !\n", mot);
        tableau(pseudo, pointsJoueur, mot);
    }
    else
    {
        printf("Dommage, t'es trop nul pour ce jeu si simple... Le mot etait : %s\'n", mot);
        tableau(pseudo, pointsJoueur, mot);
    }
}


void afficherTop10()
{
    FILE *fichier = fopen("C:\\Users\\Huawei\\Desktop\\pd\\tableau_des_scores.txt", "r");

    if (fichier == NULL)
    {
        perror("Erreur lors de l'ouverture du fichier tableau_des_scores");
        exit(EXIT_FAILURE);
    }

    printf("\n _________  ________  ________         _____  ________     \n");
    printf("|\\___   ___\\\\   __  \\|\\   __  \\       / __  \\\\|\\   __  \\    \n");
    printf("\\|___ \\  \\_\\ \\  \\|\\  \\ \\  \\|\\  \\     |\\/\\_\\  \\ \\  \\|\\  \\   \n");
    printf("     \\ \\  \\ \\ \\  \\\\\\  \\ \\   ____\\    \\|/ \\ \\  \\ \\  \\\\\\  \\  \n");
    printf("      \\ \\  \\ \\ \\  \\\\\\  \\ \\  \\___|         \\ \\  \\ \\  \\\\\\  \\ \n");
    printf("       \\ \\__\\ \\ \\_______\\ \\__\\             \\ \\__\\ \\_______\\\n");
    printf("        \\|__|  \\|_______|\\|__|              \\|__|\\|_______|\n");

    // Structure pour stocker les informations de chaque joueur
    typedef struct
    {
        char pseudo[MAX_LONGUEUR_MOT];
        int points;
        char mot[MAX_LONGUEUR_MOT];
    } Joueur;

    Joueur joueurs[10];
    int i = 0;

    char ligne[200];

    // Lire les scores du fichier et les stocker dans le tableau de joueurs
    while (fgets(ligne, sizeof(ligne), fichier) != NULL && i < 10)
    {
        // Utilise sscanf pour extraire les informations de la ligne lue
        if (sscanf(ligne, "Le joueur : %s a obtenu un score de %d. Le mot à deviner etait : %s",
                   joueurs[i].pseudo, &joueurs[i].points, joueurs[i].mot) == 3)
        {
            i++;
        }
    }

    // Fermer le fichier
    fclose(fichier);

    // Trier le tableau des joueurs par points décroissants
    for (int j = 0; j < i - 1; j++)
    {
        for (int k = j + 1; k < i; k++)
        {
            if (joueurs[k].points > joueurs[j].points)
            {
                // Échanger les éléments si nécessaire
                Joueur temp = joueurs[j];
                joueurs[j] = joueurs[k];
                joueurs[k] = temp;
            }
        }
    }

    // Afficher le top 10
    for (int j = 0; j < i && j < 10; j++)
    {
        printf("%d. Joueur : %s, Points : %d, Mot : %s\n", j + 1, joueurs[j].pseudo, joueurs[j].points, joueurs[j].mot);
    }
}

int main()
{
    char *motADeviner = choisirMotAleatoire();
    char pseudo[MAX_LONGUEUR_MOT];

    printf("Veuillez saisir votre pseudonyme : ");
    scanf("%s", pseudo);

    printf("Bienvenue dans le jeu du Pendu, %s !\nJe suis votre presentateur Mathias BAILET\n", pseudo);

    jouerPendu(motADeviner, pseudo);

    free(motADeviner);
    // Libérer la mémoire allouée

    afficherTop10();

    return 0;
}
