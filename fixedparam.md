# Extend the scheduling zoo to fixed parameter results

- in the bibtex sources allow a problem name to have four fields `alpha|beta|gamma|delta`, where delta are the fixed parameters. In the search result webpage show this problem name as `alpha|beta|gamma fixed parameter:delta`.
- the notation.xml file add a section devoted to fixed parameters. In order to avoid two choice fields, one empty and one for the actual fixed parameter, maybe we can introduce checkboxes. Then the first section can have a checkbox "advanced notation" as well.
- we allow reduction from a vector of field values to another vector of values (for the same field). In particular we could allow a reduction only in the absence of preemption. An example (which formally does not make sense), could be ("P", "") generalizes to ("R", ""). Here the empty string stands for no preemption. But since we cannot figure out which field is meant only by looking at the empty string, we allow to write that ("P", "not pmtn") generalizes to ("R", "not pmtn").
- we move the "m" in the number of machines to the fixed parameter section. Corresponding bibtex files have to be changed, ie. "Pm|beta|gamma" into "P|beta|gamma|m".

